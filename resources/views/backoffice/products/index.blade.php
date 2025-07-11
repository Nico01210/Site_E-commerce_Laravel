<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
</head>
<body>
    <h1>Liste des produits</h1>

    @if($products->isEmpty())
        <p>Aucun produit trouvé.</p>
    @else
        <ul>
            @foreach($products as $product)
                <li>{{ $product->name }} - {{ $product->price }} €</li>
              <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
                @endforeach
        </ul>
    @endif
</body>
</html>