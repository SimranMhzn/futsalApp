<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FutsalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', fn() => "Server is working!")->name('test');

// ===========================
// Registration
// ===========================
Route::get('/register/user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user.form');
Route::post('/register/user', [AuthController::class, 'registerUser']);

Route::get('/register/futsal', [AuthController::class, 'showFutsalRegistrationForm'])->name('register.futsal.form');
Route::post('/register/futsal', [AuthController::class, 'registerFutsal']);

// ===========================
// Login
// ===========================
Route::get('/login', fn() => redirect()->route('login.user.form'))->name('login'); 
Route::get('/login/user', [AuthController::class, 'showUserLoginForm'])->name('login.user.form');
Route::post('/login/user', [AuthController::class, 'loginUser']);

Route::get('/login/futsal', [AuthController::class, 'showFutsalLoginForm'])->name('login.futsal.form');
Route::post('/login/futsal', [AuthController::class, 'loginFutsal']);

Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin.form');
Route::post('/login/admin', [AuthController::class, 'loginAdmin']);

// ===========================
// Logout
// ===========================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('futsal')->group(function () {
    Route::get('/', [FutsalController::class, 'index'])->name('futsal.index');
    Route::get('/{id}', [FutsalController::class, 'show'])->name('futsal.show');

    Route::middleware(['auth:futsal'])->group(function () {
        Route::get('/create', [FutsalController::class, 'create'])->name('futsal.create');
        Route::post('/', [FutsalController::class, 'store'])->name('futsal.store');
        Route::get('/{futsal}/edit', [FutsalController::class, 'edit'])->name('futsal.edit');
        Route::put('/{futsal}', [FutsalController::class, 'update'])->name('futsal.update');
        Route::delete('/{futsal}', [FutsalController::class, 'destroy'])->name('futsal.destroy');
        Route::get('/profile', [AuthController::class, 'profile'])->name('futsal.profile');
        Route::get('/futsal/my-status', [FutsalController::class, 'myFutsalStatus'])->name('futsal.my-status');
    });
});

// ===========================
// Bookings
// ===========================
Route::middleware(['auth'])->group(function () {
    Route::get('/user/home', fn() => view('user.home'))->name('user.home');
    Route::get('/history', [BookingController::class, 'index'])->name('booking.history');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/booking/{futsal}', [BookingController::class, 'create'])->name('booking.create');
});

// ===========================
// Profile
// ===========================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ===========================
// Blogs
// ===========================
Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::get('/futsals/pending', [FutsalController::class, 'pendingFutsals'])
        ->name('futsals.pending');

    // Approve a futsal
    Route::post('futsals/{id}/approve', [FutsalController::class, 'approveFutsal'])
        ->name('futsals.approve');

    // Reject a futsal
    Route::post('futsals/{id}/reject', [FutsalController::class, 'rejectFutsal'])
        ->name('futsals.reject');
    });


