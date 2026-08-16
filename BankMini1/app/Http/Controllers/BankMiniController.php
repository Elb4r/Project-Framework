<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BankMiniController extends Controller
{
    // Existing methods...
    
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role != 'bank_mini') {
                return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            $topups = TopUp::where('status', 'pending')->get();
            $withdrawals = Withdrawal::where('status', 'pending')->get();
            $transfers = Transaction::where('type', 'Transfer')
                ->where('status', 'pending')
                ->with(['sender', 'recipient'])
                ->get();
            
            return view('bank.dashboard', compact('topups', 'withdrawals', 'transfers'));
        }
    }

    public function approveTransfer($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
    
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaksi tidak ditemukan atau sudah diproses.');
        }
    
        // Update status transaksi menjadi 'approved'
        $transaction->status = 'approved';
        $transaction->save();
    
        // Update saldo pengirim dan penerima
        $sender = User::find($transaction->sender_id);
        $recipient = User::find($transaction->recipient_id);
    
        $sender->balance -= $transaction->amount;
        $recipient->balance += $transaction->amount;
    
        $sender->save();
        $recipient->save();
    
        // Simpan transaksi ke dalam tabel transaksi
        Transaction::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'amount' => $transaction->amount,
            'type' => 'Transfer',
            'status' => 'Berhasil',
        ]);
    
        return redirect()->route('bankmini.dashboard')->with('success', 'Transfer berhasil disetujui.');
    }
    
    public function rejectTransfer($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->status = 'rejected';
        $transaction->save();
    
        return redirect()->route('bankmini.dashboard')->with('success', 'Transfer telah ditolak.');
    }    

    public function transactionHistory()
{
      // Mengambil transaksi di mana pengirim atau penerima adalah siswa
      $transactions = Transaction::where(function ($query) {
        // Filter berdasarkan pengirim yang berperan sebagai siswa
        $query->whereHas('sender', function ($query) {
            $query->where('role', 'siswa');
        })
        // Atau filter berdasarkan penerima yang berperan sebagai siswa
        ->orWhereHas('recipient', function ($query) {
            $query->where('role', 'siswa');
        });
    })->get(); // Mendapatkan semua transaksi yang sesuai dengan filter

    return view('bank.transaksi', compact('transactions'));
}


    public function topUpForm()
    {
        return view('students.topup'); 
    }

    public function acceptTopUp($id)
    {
        $topup = TopUp::findOrFail($id);

        $topup->status = 'approved';
        $topup->save();

        // Tambahkan saldo siswa
        $user = $topup->user;
        $user->balance += $topup->amount; 
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'sender_id' => null, 
            'recipient_id' => $user->id, 
            'amount' => $topup->amount,
            'type' => 'Top-Up',
            'status' => 'Berhasil',
        ]);

        return redirect()->route('bankmini.dashboard')->with('success', 'Top-up diterima dan saldo telah diperbarui.');
    }

    public function rejectTopUp($id)
    {
        $topup = TopUp::findOrFail($id);
        $topup->status = 'rejected';
        $topup->save();

        return redirect()->route('bankmini.dashboard')->with('success', 'Top-up ditolak.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function topUpToStudent(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'user_name' => 'required|exists:users,name',
            'amount' => 'required|numeric|min:1000',
        ]);

        // Ambil user (siswa) yang akan di-top-up berdasarkan nama
        $user = User::where('name', $request->user_name)->firstOrFail();

        // Pastikan saldo yang di-top-up adalah angka positif
        if ($request->amount <= 0) {
            return redirect()->route('bankmini.dashboard')->with('error', 'Jumlah top-up harus lebih besar dari 0.');
        }

        // Update saldo siswa
        $user->balance += $request->amount;
        $user->save();

        // Simpan transaksi untuk top-up
        Transaction::create([
            'user_id' => Auth::id(),
            'sender_id' => null,
            'recipient_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'Top-Up',
            'status' => 'Berhasil',
        ]);

        return redirect()->route('bankmini.dashboard')->with('success', 'Top-up berhasil dilakukan ke akun siswa.');
    }
    
    public function users()
    {
        // Check if user is authorized
        if (Auth::user()->role != 'bank_mini') {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        // Get all users with a focus on students
        $users = User::orderBy('role')
                      ->orderBy('name')
                      ->get();
        
        return view('bank.users', compact('users'));
    }
    
    /**
     * Store a new user created by bank mini
     */
    public function storeUser(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,bank_mini,siswa',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('bankmini.users')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal membuat pengguna. Silakan periksa input Anda.');
        }
        
        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'balance' => 0, // Initialize with zero balance
        ]);
        
        return redirect()->route('bankmini.users')
            ->with('success', 'Pengguna baru berhasil dibuat.');
    }
}