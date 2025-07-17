<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backoffice\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Routes pour les pages du site
Route::get('/acheter', function () {
    return view('acheter');
});

Route::get('/vendre', function () {
    return view('vendre');
});

Route::get('/apropos', function () {
    return view('apropos');
});

Route::get('/moncompte', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/moncompte', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('inscription');
Route::post('/inscription', [RegisterController::class, 'register'])->name('register');

// Route pour accéder au backoffice
Route::get('/admin', function () {
    return redirect('/backoffice/produits');
});

// Routes du backoffice
Route::get('/backoffice', function () {
    return redirect('/backoffice/produits');
});

Route::prefix('backoffice')->name('backoffice.')->group(function () {
    Route::resource('produits', \App\Http\Controllers\Backoffice\ProductController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
