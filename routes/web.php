<?php

use Illuminate\Support\Facades\Route;

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