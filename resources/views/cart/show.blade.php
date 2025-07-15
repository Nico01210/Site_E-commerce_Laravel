<h1>Contenu du panier</h1>

@if($cart && $cart->products->count())
    <ul>
    @foreach ($cart->products as $product)
        <li>
            {{ $product->name }} — {{ $product->price }} €
            (x {{ $product->pivot->quantity }})
        </li>
    @endforeach
    </ul>
@else
    <p>Panier vide</p>
@endif