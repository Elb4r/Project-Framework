<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function dashboard()
    {
        // Mengambil data pengguna berdasarkan role
        $admins = User::where('role', 'admin')->get();
        $students = User::where('role', 'siswa')->get();
        $bankMinis = User::where('role', 'bank_mini')->get();

        // Mengirim data ke view dashboard
        return view('admin.dashboard', compact('admins', 'students', 'bankMinis'));
    }

    public function showTransactions()
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

        return view('admin.transactions', compact('transactions'));
    }   


    // Menampilkan halaman kelola pengguna
    public function manageUsers()
    {
        // Mengambil semua pengguna
        $users = User::all();

        return view('admin.users', compact('users'));
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed', // Pastikan password dikonfirmasi
        'role' => 'required|in:admin,bank_mini,siswa',
    ]);

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil dibuat!');
    } catch (\Exception $e) {
        return redirect()->route('admin.users')->with('error', 'Gagal membuat user. Coba lagi.');
    }
}


    // Menampilkan form edit pengguna
    public function edit($id)
    {
        // Mencari pengguna berdasarkan id
        $user = User::findOrFail($id);

        // Mengirim data pengguna ke form edit
        return view('admin.edit_user', compact('user'));
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,bank_mini,siswa',
        ]);

        try {
            // Mengambil data pengguna yang akan diupdate
            $user = User::findOrFail($id);
            
            // Update data pengguna
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            // Redirect ke halaman manage users dengan pesan sukses
            return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui!');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->route('admin.users')->with('error', 'Gagal memperbarui user. Coba lagi.');
        }
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        try {
            // Mencari pengguna berdasarkan id dan menghapusnya
            $user = User::findOrFail($id);
            $user->delete();

            // Redirect ke halaman manage users dengan pesan sukses
            return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->route('admin.users')->with('error', 'Gagal menghapus user. Coba lagi.');
        }
    }
}
