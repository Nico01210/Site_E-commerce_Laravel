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
public function update(Request $request, $cartId)
{
    $cart = \App\Models\Cart::with('products')->findOrFail($cartId);

    $validated = $request->validate([
        'products' => 'required|array',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    foreach ($validated['products'] as $productId => $data) {
        $cart->products()->updateExistingPivot($productId, [
            'quantity' => $data['quantity']
        ]);
    }

    return redirect()->route('cart.show', $cart->id)->with('success', 'Panier mis à jour.');
}
}

