<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FutsalController;

// Public routes
Route::get('/', function () {
    return view('app'); // Your main React app
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes for logged-in users
Route::middleware(['auth'])->group(function () {

    // Return all futsals for the logged-in user as JSON
    Route::get('/futsals', [FutsalController::class, 'index'])->name('futsals.index');

    // Other futsal actions...
    Route::post('/futsals', [FutsalController::class, 'store'])->name('futsals.store');
    Route::get('/futsals/{id}/edit', [FutsalController::class, 'edit'])->name('futsals.edit');
    Route::put('/futsals/{id}', [FutsalController::class, 'update'])->name('futsals.update');
    Route::delete('/futsals/{id}', [FutsalController::class, 'destroy'])->name('futsals.destroy');
});
