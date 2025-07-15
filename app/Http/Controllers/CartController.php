<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class CartController extends Controller
{

public function show($userId)
{
    $user = User::with('cart.products')->findOrFail($userId);
    $cart = $user->cart;

    return view('cart.show', compact('cart'));
}
}
