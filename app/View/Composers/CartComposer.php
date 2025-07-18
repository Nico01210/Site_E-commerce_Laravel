<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartComposer
{
    public function compose(View $view)
    {
        $cartItemsCount = 0;
        
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            
            if ($cart) {
                $cartItemsCount = $cart->products()->sum('cart_product.quantity');
            }
        }
        
        $view->with('cartItemsCount', $cartItemsCount);
    }
}
