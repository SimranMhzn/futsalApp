<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FutsalController;

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

// Registration
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('futsals')->group(function () {

    // Public: List all futsals
    Route::get('/', [FutsalController::class, 'index'])->name('futsals.index');

    // Owner only (authenticated users)
    Route::middleware(['auth'])->group(function () {
        Route::get('/create', [FutsalController::class, 'create'])->name('futsals.create');
        Route::post('/', [FutsalController::class, 'store'])->name('futsals.store');
        Route::get('/{futsal}/edit', [FutsalController::class, 'edit'])->name('futsals.edit');
        Route::put('/{futsal}', [FutsalController::class, 'update'])->name('futsals.update');
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::delete('/{futsal}', [FutsalController::class, 'destroy'])->name('futsals.destroy');
    });

    // Show single futsal (must be last: dynamic route)
    Route::get('/{id}', [FutsalController::class, 'show'])->name('futsals.show');
});

