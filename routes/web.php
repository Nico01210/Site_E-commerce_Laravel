<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Homepage";
});

Route::get('/product', function () {
    return "Liste des produits";
});

Route::get('/product/{id}', function ($id) {
    return "Fiche du produit " . $id;
})->where('id', '[0-9]+');

Route::get('/cart', function () {
    return "Panier";
});