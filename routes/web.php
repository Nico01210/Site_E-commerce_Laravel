<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backoffice\ProductController as BackofficeProductController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Alias pour la connexion (redirige vers Breeze)
Route::get('/moncompte', function () {
    return redirect()->route('login');
})->name('moncompte');

Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('inscription');
Route::post('/inscription', [RegisterController::class, 'register'])->name('inscription.submit');

// Route pour accéder au backoffice (uniquement pour les admins)
Route::middleware(['auth', 'is_admin'])->get('/admin', function () {
    return redirect('/backoffice/produits');
});

// Routes du backoffice (uniquement pour les admins)
Route::middleware(['auth', 'is_admin'])->get('/backoffice', function () {
    return redirect('/backoffice/produits');
});

Route::middleware(['auth', 'is_admin'])->prefix('backoffice')->name('backoffice.')->group(function () {
    Route::resource('produits', BackofficeProductController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes admin avec middleware is_admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Route de diagnostic pour les permissions (à supprimer en production)
Route::get('/diagnostic-permissions', function () {
    $publicPath = public_path();
    $imagesPath = public_path('images');
    $productsPath = public_path('images/products');
    
    $info = [
        'base_path' => base_path(),
        'public_path' => $publicPath,
        'images_path' => $imagesPath,
        'products_path' => $productsPath,
        'public_exists' => file_exists($publicPath),
        'public_writable' => is_writable($publicPath),
        'images_exists' => file_exists($imagesPath),
        'images_writable' => is_writable($imagesPath),
        'products_exists' => file_exists($productsPath),
        'products_writable' => is_writable($productsPath),
        'php_user' => get_current_user(),
        'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
        'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown'
    ];
    
    if (file_exists($productsPath)) {
        $info['products_permissions'] = substr(sprintf('%o', fileperms($productsPath)), -4);
        $info['products_owner'] = fileowner($productsPath);
    }
    
    return response()->json($info, 200, [], JSON_PRETTY_PRINT);
});

// Route de test pour vérifier l'authentification (à supprimer en production)
Route::get('/test-auth', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json([
            'authenticated' => true,
            'user' => $user->only(['id', 'name', 'email', 'is_admin']),
            'is_admin' => $user->is_admin,
            'can_access_backoffice' => $user->is_admin
        ]);
    } else {
        return response()->json([
            'authenticated' => false,
            'message' => 'Non connecté'
        ]);
    }
});

require __DIR__.'/auth.php';
