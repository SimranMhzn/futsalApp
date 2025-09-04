<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/{any}', function () {
    return view('app'); // Blade view where React mounts
})->where('any', '.*');

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// Route::middleware(['auth'])->group(function (){
//     Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');
//     Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');

//     Route::get('/chirps/{id}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');
//     Route::put('/chirps/{id}', [ChirpController::class, 'update'])->name('chirps.update');

//     Route::delete('/chirps/{id}', [ChirpController::class, 'destroy'])->name('chirps.destroy');
// });