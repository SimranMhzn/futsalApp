<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FutsalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => view('home'))->name('home');
Route::get('/test', fn() => "Server is working!")->name('test');

Route::get('/register/user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user.form');
Route::post('/register/user', [AuthController::class, 'registerUser'])->name('register.user');

Route::get('/register/futsal', [AuthController::class, 'showFutsalRegistrationForm'])->name('register.futsal.form');
Route::post('/register/futsal', [AuthController::class, 'registerFutsal'])->name('register.futsal');

Route::get('/login', fn() => redirect()->route('login.user.form'))->name('login');

Route::get('/login/user', [AuthController::class, 'showUserLoginForm'])->name('login.user.form');
Route::post('/login/user', [AuthController::class, 'loginUser'])->name('login.user');

Route::get('/login/futsal', [AuthController::class, 'showFutsalLoginForm'])->name('login.futsal.form');
Route::post('/login/futsal', [AuthController::class, 'loginFutsal'])->name('login.futsal');

Route::get('/login/admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin.form');
Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/user/home', fn() => view('user.home'))->name('user.home');

    Route::get('/history', [BookingController::class, 'index'])->name('booking.history');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

Route::middleware(['auth:web,futsal'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/validate-password', [ProfileController::class, 'validatePassword'])->name('profile.validate-password');
});

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
    });
});

Route::get('/booking/{futsal}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/payment', [BookingController::class, 'khaltiPayment'])->name('booking.payment');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    });
