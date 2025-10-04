<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FutsalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/ownerRegister', [AuthController::class, 'showOwnerRegistrationForm'])->name('ownerRegister.form');
Route::post('/ownerRegister', [AuthController::class, 'ownerRegister'])->name('ownerRegister');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/futsals', [FutsalController::class, 'index'])->name('futsals.index');
    Route::post('/futsals', [FutsalController::class, 'store'])->name('futsals.store');
    Route::get('/futsals/{id}/edit', [FutsalController::class, 'edit'])->name('futsals.edit');
    Route::put('/futsals/{id}', [FutsalController::class, 'update'])->name('futsals.update');
    Route::delete('/futsals/{id}', [FutsalController::class, 'destroy'])->name('futsals.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/futsals', [FutsalController::class, 'adminIndex'])->name('futsals.adminIndex');
    Route::post('/admin/futsals', [FutsalController::class, 'adminStore'])->name('futsals.adminStore');

    Route::get('/admin/futsals/{id}/edit', [FutsalController::class, 'adminEdit'])->name('futsals.adminEdit');
    Route::put('/admin/futsals/{id}', [FutsalController::class, 'adminUpdate'])->name('futsals.adminUpdate');

    Route::delete('/admin/futsals/{id}', [FutsalController::class, 'adminDestroy'])->name('futsals.adminDestroy');
});