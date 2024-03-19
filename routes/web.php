<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/masuk');

Route::middleware(['guest'])->controller(AuthController::class)->group(function (): void {
    Route::get('/masuk', 'login')->name('login');
    Route::post('/masuk', 'authenticate')->name('authenticate');
});

Route::middleware(['auth'])->group(function (): void {
    Route::controller(DashboardController::class)->group(function (): void {
        Route::get('/beranda', 'index')->name('dashboard');
    });

    // Member
    Route::controller(MemberController::class)->group(function (): void {
        Route::get('/anggota', 'index')->name('members');
        Route::get('/anggota/tambah', 'create')->name('members.create');
        Route::post('/anggota', 'store')->name('members.store');
        Route::get('/anggota/{member}/edit', 'edit')->name('members.edit');
        Route::put('/anggota/{member}', 'update')->name('members.update');
        Route::delete('/anggota/{member}', 'destroy')->name('members.destroy');
    });

    // Category
    Route::controller(CategoryController::class)->group(function (): void {
        Route::get('/kategori', 'index')->name('categories');
        Route::get('/kategori/tambah', 'create')->name('categories.create');
        Route::post('/kategori', 'store')->name('categories.store');
        Route::get('/kategori/{category}/edit', 'edit')->name('categories.edit');
        Route::put('/kategori/{category}', 'update')->name('categories.update');
        Route::delete('/kategori/{category}', 'destroy')->name('categories.destroy');
    });

    // Bookshelf
    Route::controller(BookshelfController::class)->group(function (): void {
        Route::get('/rak-buku', 'index')->name('bookshelves');
        Route::get('/rak-buku/tambah', 'create')->name('bookshelves.create');
        Route::post('/rak-buku', 'store')->name('bookshelves.store');
        Route::get('/rak-buku/{bookshelf}/edit', 'edit')->name('bookshelves.edit');
        Route::put('/rak-buku/{bookshelf}', 'update')->name('bookshelves.update');
        Route::delete('/rak-buku/{bookshelf}', 'destroy')->name('bookshelves.destroy');
    });

    // Book
    Route::controller(BookController::class)->group(function (): void {
        Route::get('/buku', 'index')->name('books');
        Route::get('/buku/tambah', 'create')->name('books.create');
        Route::post('/buku', 'store')->name('books.store');
        Route::get('/buku/{book}/edit', 'edit')->name('books.edit');
        Route::put('/buku/{book}', 'update')->name('books.update');
        Route::delete('/buku/{book}', 'destroy')->name('books.destroy');
    });

    // Loan
    Route::controller(LoanController::class)->group(function (): void {
        Route::get('/peminjaman-buku', 'index')->name('loans');
        Route::get('/peminjaman-buku/tambah', 'create')->name('loans.create');
        Route::post('/peminjaman-buku', 'store')->name('loans.store');
        Route::get('/peminjaman-buku/{loan}/proses', 'process')->name('loans.process');
        Route::patch('/peminjaman-buku/{loan}', 'update')->name('loans.update');
        Route::get('/riwayat-peminjaman', 'history')->name('loans.history');
        Route::get('api/grafik-peminjaman', 'loanChart')->name('api.loan-chart');
    });

    // Report
    Route::controller(ReportController::class)->group(function (): void {
        Route::get('/laporan-peminjaman-buku', 'loanReport')->name('report.loan');
        Route::post('/laporan-peminjaman-buku', 'generateLoanReport')->name('report.generate-loan');
        Route::get('/laporan-pengembalian-buku', 'returnReport')->name('report.return');
        Route::post('/laporan-pengembalian-buku', 'generateReturnReport')->name('report.generate-return');
    });

    // Profile
    Route::controller(ProfileController::class)->group(function (): void {
        Route::get('/profil-saya', 'index')->name('profile');
        Route::patch('/profil-saya/{user}', 'update')->name('profile.update');
        Route::patch('/profil-saya/{user}/password', 'changePassword')->name('profile.change-password');
        Route::delete('/profil-saya/{user}', 'destroy')->name('profile.destroy');
    });

    // User
    Route::controller(UserController::class)->group(function (): void {
        Route::get('/pengguna', 'index')->name('users')->middleware(['admin']);
        Route::get('/pengguna/tambah', 'create')->name('users.create')->middleware(['admin']);
        Route::post('/pengguna', 'store')->name('users.store')->middleware(['admin']);
        Route::get('/pengguna/{user}/edit', 'edit')->name('users.edit')->middleware(['admin']);
        Route::put('/pengguna/{user}', 'update')->name('users.update')->middleware(['admin']);
        Route::delete('/pengguna/{user}', 'destroy')->name('users.destroy')->middleware(['admin']);
    });

    // Setting
    Route::controller(SettingController::class)->group(function (): void {
        Route::get('/pengaturan', 'index')->name('settings');
        Route::put('/pengaturan', 'update')->name('settings.update');
    });

    // Logout
    Route::delete('/keluar', [AuthController::class, 'logout'])->name('logout');
});
