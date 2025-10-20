<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FutsalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/futsals', [FutsalController::class, 'index'])->name('futsals.index');
    Route::get('/my-bookings', [FutsalController::class, 'myBookings'])->name('bookings.index');
    Route::post('/futsals/{futsal}/book', [FutsalController::class, 'book'])->name('futsals.book');
    Route::middleware('owner')->group(function () {
        Route::post('/futsals', [FutsalController::class, 'store'])->name('futsals.store');
        Route::get('/futsals/{id}/edit', [FutsalController::class, 'edit'])->name('futsals.edit');
        Route::put('/futsals/{id}', [FutsalController::class, 'update'])->name('futsals.update');
        Route::delete('/futsals/{id}', [FutsalController::class, 'destroy'])->name('futsals.destroy');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/futsals', [FutsalController::class, 'adminIndex'])->name('futsals.adminIndex');
});
