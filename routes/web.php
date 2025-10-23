<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FutsalController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', function () {
    return "Server is working!";
})->name('test');

//
Route::get('/blog', function () {
    return view('blog'); 
})->name('blog');

// Registration routes
// Show registration forms
Route::get('/register/user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user.form');
Route::get('/register/futsal', [AuthController::class, 'showFutsalRegistrationForm'])->name('register.futsal.form');
Route::post('/register/user', [AuthController::class, 'registerUser'])->name('register.user');
Route::post('/register/futsal', [AuthController::class, 'registerFutsal'])->name('register.futsal');

Route::get('login', function() {
    return redirect()->route('login.user'); // or show a page to choose login type
})->name('login');

// User login
Route::get('/login/user', [AuthController::class, 'showUserLoginForm'])->name('login.user.form');
Route::post('/login/user', [AuthController::class, 'loginUser'])->name('login.user');

// Futsal login
Route::get('/login/futsal', [AuthController::class, 'showFutsalLoginForm'])->name('login.futsal.form');
Route::post('/login/futsal', [AuthController::class, 'loginFutsal'])->name('login.futsal');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user/home', function () {
    return view('user.home');
})->middleware('auth')->name('user.home');

Route::get('/futsal/home', [FutsalController::class, 'index'])
    ->middleware('auth:futsal') 
    ->name('futsal.home');

Route::get('/booking/{futsal}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/history', [BookingController::class, 'index'])
    ->middleware('auth')
    ->name('booking.history');

Route::delete('/booking/{id}', [BookingController::class, 'destroy'])
    ->middleware('auth')
    ->name('booking.destroy');


Route::prefix('futsal')->group(function () {
    Route::get('/', [FutsalController::class, 'index'])->name('futsal.index');

    Route::middleware(['auth:futsal'])->group(function () {
    Route::get('/create', [FutsalController::class, 'create'])->name('futsal.create');
    Route::post('/', [FutsalController::class, 'store'])->name('futsal.store');
    Route::get('/{futsal}/edit', [FutsalController::class, 'edit'])->name('futsal.edit');
    Route::put('/{futsal}', [FutsalController::class, 'update'])->name('futsal.update');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::delete('/{futsal}', [FutsalController::class, 'destroy'])->name('futsal.destroy');
});


    Route::get('/{id}', [FutsalController::class, 'show'])->name('futsal.show');
});

