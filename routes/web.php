<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
});
Route::get('/formulaire-vente', function () {
    return view('formulaire-vente'); // sans l'extension .php ni le dossier views
})->name('formulaire-de-vente');
Route::post('/formulaire-vente', function (Request $request) {
    // Ici tu traites les données du formulaire
    // Par exemple : sauvegarder en BDD, envoyer un mail, etc.

    // Pour test : retourner les données
    return dd($request->all());
})->name('vente.submit');

Route::get('/inscription', function () {
    return view('inscription');
})->name('inscription');

Route::get('/moncompte', function () {
    return view('moncompte');
})->name('moncompte');
Route::get('/bonlivraison', function () {
    return view('bonlivraison');
})->name('bonlivraison');