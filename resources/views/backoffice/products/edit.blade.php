<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    Nom: <input type="text" name="name" value="{{ $product->name }}"><br>
    Prix: <input type="number" name="price" value="{{ $product->price }}"><br>
    <button type="submit">Mettre à jour</button>
</form>
