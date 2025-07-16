<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\Backoffice\ProductController as BackofficeProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddressController;



Route::get('/', function () {
    return view('home');
});

Route::get('/acheter', function () {
    return view('acheter');
});

Route::get('/vendre', function () {
    return view('vendre');
});

Route::get('/apropos', function () {
    return view('apropos');
});

Route::get('/moncompte', function () {
    return view('moncompte');
})->name('moncompte');

Route::get('/formulaire-vente', function () {
    return view('formulaire-vente');
})->name('formulaire-de-vente');

Route::post('/formulaire-vente', function (Request $request) {
    // Traitement du formulaire de vente
    return dd($request->all());
})->name('vente.submit');

Route::get('/inscription', function () {
    return view('inscription');
})->name('inscription');

Route::get('/bonlivraison', function () {
    return view('bonlivraison');
})->name('bonlivraison');

// Routes produits
Route::get('/products', [ProductController::class, 'index']); // doublon possible, à garder si besoin

// Route backoffice
Route::get('/backoffice', [BackofficeProductController::class, 'index']);

Route::prefix('backoffice')->name('backoffice.')->group(function () {
    Route::get('/produits', [BackofficeProductController::class, 'index'])->name('produits.index');
    Route::get('/produit/new', [BackofficeProductController::class,  'create'])->name('produits.create');
    Route::post('/produits', [BackofficeProductController::class, 'store'])->name('produits.store');
    Route::get('/produit/{produit}', [BackofficeProductController::class, 'show'])->name('produits.show');
    Route::get('/produit/{produit}/edit', [BackofficeProductController::class, 'edit'])->name('produits.edit');
    Route::put('/produit/{produit}', [BackofficeProductController::class, 'update'])->name('produits.update');
    Route::delete('/produit/{produit}', [BackofficeProductController::class, 'destroy'])->name('produits.destroy');
});



Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/cart/{userId}', [CartController::class, 'show']);

Route::get('/user/{id}/addresses', [AddressController::class, 'index']);
Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');

