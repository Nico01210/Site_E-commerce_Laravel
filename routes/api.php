<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


Route::apiResource('produits', ProductController::class);