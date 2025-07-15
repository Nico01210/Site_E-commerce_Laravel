<h1>Contenu du panier</h1>

<form action="{{ route('cart.update', $cart->id) }}" method="POST">
    @csrf
    @method('PUT')

    @foreach($cart->products as $product)
        <div class="product-item">
            <label for="product-{{ $product->id }}">{{ $product->name }}</label>
            <input type="number" 
                   id="product-{{ $product->id }}" 
                   name="products[{{ $product->id }}][quantity]" 
                   value="{{ old('products.' . $product->id . '.quantity', $product->pivot->quantity) }}" 
                   min="0" />
            
            @error("products.{$product->id}.quantity")
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    @endforeach

    <button type="submit">Mettre à jour le panier</button>
</form>
