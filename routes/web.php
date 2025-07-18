<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Backoffice\ProductController as BackofficeProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'home'])->name('home');

// Routes pour les pages du site
Route::get('/acheter', [ProductController::class, 'acheter'])->name('acheter');
Route::get('/produit/{id}', [ProductController::class, 'show'])->name('produits.show');

// Routes du panier
Route::post('/panier/ajouter/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/panier', [CartController::class, 'showCart'])->name('cart.show')->middleware('auth');
Route::delete('/panier/supprimer/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove')->middleware('auth');
Route::post('/panier/vider', [CartController::class, 'clearCart'])->name('cart.clear')->middleware('auth');

Route::get('/vendre', function () {
    return view('vendre');
});

Route::get('/formulaire-vente', function () {
    return view('formulaire-vente');
})->name('formulaire-vente');

Route::post('/formulaire-vente', function (Illuminate\Http\Request $request) {
    // Pour l'instant, on redirige simplement avec un message de succès
    return redirect()->route('formulaire-vente')->with('success', 'Votre demande a été envoyée avec succès ! Nous vous recontacterons rapidement.');
})->name('formulaire-vente.submit');

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
})->middleware('auth');

// Routes du backoffice
Route::get('/backoffice', function () {
    return redirect('/backoffice/produits');
})->middleware('auth');

Route::prefix('backoffice')->name('backoffice.')->middleware('auth')->group(function () {
    Route::resource('produits', BackofficeProductController::class);
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
