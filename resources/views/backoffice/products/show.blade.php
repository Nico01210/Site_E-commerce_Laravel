<h1>Détails du produit</h1>

<p><strong>Nom :</strong> {{ $product->name }}</p>
<p><strong>Prix :</strong> {{ $product->price }} €</p>
<p><strong>Description :</strong> {{ $product->description }}</p>
<p><strong>Stock :</strong> {{ $product->stock }}</p>
<p><strong>État :</strong> {{ $product->etat }}</p>

<form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
    @csrf
    @method('DELETE')
    <button type="submit">Supprimer</button>
</form>

<a href="{{ route('products.index') }}">Retour à la liste</a>
