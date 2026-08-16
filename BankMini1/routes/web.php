<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankMiniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\AuthController;
// login
Route::middleware(['auth'])->group(function (){
Route::get('/', [AuthController::class,'showLoginForm'])->name('login');
});

// Rute untuk login dan logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Contoh rute untuk top-up (bank mini)
Route::get('/bankmini/topup', [BankMiniController::class, 'topUpForm'])->name('bankmini.topup'); // Menampilkan form top-up
Route::post('/bankmini/topup', [BankMiniController::class, 'processTopUp'])->name('bankmini.processTopUp'); // Memproses top-up

// Admin Routes
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/transactions', [AdminController::class, 'showTransactions'])->name('admin.transactions');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/admin/users/store', [AdminController::class, 'store'])->name('admin.users.store');
});


// Routes untuk siswa
Route::middleware(['auth'])->group(function () {
    Route::get('/students/dashboard', [StudentController::class, 'dashboard'])->name('students.dashboard');
    Route::get('/students/transaction', [StudentController::class, 'transactionForm'])->name('students.make-transaction');
    Route::get('/students/history', [StudentController::class, 'transactionHistory'])->name('students.history');
    Route::get('/students/topup', [StudentController::class, 'topUpForm'])->name('students.topup');
    Route::post('/students/topup', [StudentController::class, 'processTopUp'])->name('students.topup.post');
    Route::get('/students/withdraw', [StudentController::class, 'withdrawForm'])->name('students.withdraw');
    Route::post('/students/withdraw', [StudentController::class, 'processWithdraw'])->name('students.withdraw.process');
    Route::get('/students/transfer', [StudentController::class, 'transferForm'])->name('students.transfer');
    Route::post('/students/transfer', [StudentController::class, 'processTransfer'])->name('students.transfer.process');
});

// Bank Mini Routes
Route::middleware(['auth', 'role:bank_mini'])->group(function () {
    Route::get('/bank/dashboard', [BankMiniController::class, 'dashboard'])->name('bankmini.dashboard');
    Route::post('/bankmini/topup-to-student', [BankMiniController::class, 'topUpToStudent'])->name('bankmini.topupToStudent');
    Route::get('/bank-mini/transactions', [BankMiniController::class, 'transactionHistory'])->name('bankmini.transaction');
    Route::post('/bank-mini/topup/accept/{id}', [BankMiniController::class, 'acceptTopUp'])->name('bankmini.topup.accept');
    Route::post('/bank-mini/topup/reject/{id}', [BankMiniController::class, 'rejectTopUp'])->name('bankmini.topup.reject');
    Route::post('/students/withdraw/approve/{id}', [StudentController::class, 'approveWithdraw'])->name('students.withdraw.approve');
    Route::post('/bankmini/withdraw/reject/{id}', [StudentController::class, 'rejectWithdraw'])->name('students.withdraw.reject');
    Route::post('/bank-mini/transfer/approve/{id}', [BankMiniController::class, 'approveTransfer'])->name('bankmini.transfer.approve');
    Route::post('/bank-mini/transfer/reject/{id}', [BankMiniController::class, 'rejectTransfer'])->name('bankmini.transfer.reject');
    Route::get('/bankmini/users', [App\Http\Controllers\BankMiniController::class, 'users'])->name('bankmini.users');
    Route::post('/bankmini/users/store', [App\Http\Controllers\BankMiniController::class, 'storeUser'])->name('bankmini.users.store');
});



// Rute untuk melihat riwayat transaksi siswa
Route::get('/students/history', [StudentController::class, 'transactionHistory'])->name('students.history');

// Dashboard Route (untuk pengguna yang sudah login)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Bank Mini Ke Siswa
Route::middleware(['auth', 'role:bankmini'])->group(function () {
    Route::get('/bankmini/dashboard', [BankMiniController::class, 'dashboard'])->name('bank.dashboard');
    Route::post('/bankmini/topup/direct', [BankMiniController::class, 'topUpToStudent'])->name('bankmini.topup.direct');
});
