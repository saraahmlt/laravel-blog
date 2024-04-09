<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagecontrol;
use App\Http\Controllers\pageAboutUs;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/legals', [pagecontrol::class, 'legals'])->name('legals.edit');

Route::get('/aboutus', [pageAboutUs::class, 'aboutus'])->name('aboutus.edit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
