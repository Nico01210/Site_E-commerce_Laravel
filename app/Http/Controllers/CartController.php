<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Ajouter un produit au panier
     */
    public function addToCart(Request $request, $productId)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter des produits au panier.');
        }

        $product = Product::findOrFail($productId);
        $user = Auth::user();

        // Obtenir ou créer le panier de l'utilisateur
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Vérifier si le produit est déjà dans le panier
        $existingProduct = $cart->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            // Si le produit existe déjà, augmenter la quantité
            $newQuantity = $existingProduct->pivot->quantity + 1;
            
            // Vérifier le stock disponible
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Stock insuffisant pour ce produit.');
            }
            
            $cart->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);
            $message = 'Quantité mise à jour dans le panier !';
        } else {
            // Vérifier le stock
            if ($product->stock < 1) {
                return back()->with('error', 'Ce produit n\'est plus en stock.');
            }
            
            // Ajouter le produit au panier avec une quantité de 1
            $cart->products()->attach($productId, ['quantity' => 1]);
            $message = 'Produit ajouté au panier !';
        }

        return back()->with('success', $message);
    }

    /**
     * Afficher le contenu du panier de l'utilisateur connecté
     */
    public function showCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir votre panier.');
        }

        $cart = Cart::where('user_id', Auth::id())->with('products')->first();
        $products = $cart ? $cart->products : collect();

        // Calculer le total
        $total = $products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        return view('cart.index', compact('products', 'total'));
    }

    /**
     * Supprimer un produit du panier
     */
    public function removeFromCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = Cart::where('user_id', Auth::id())->first();
        
        if ($cart) {
            $cart->products()->detach($productId);
        }

        return back()->with('success', 'Produit retiré du panier.');
    }

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

public function clearCart()
{
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => 'Non autorisé'], 401);
    }

    $cart = Cart::where('user_id', Auth::id())->first();
    
    if ($cart) {
        // Supprimer tous les produits du panier
        $cart->products()->detach();
    }

    return response()->json(['success' => true, 'message' => 'Panier vidé avec succès']);
}
}

