<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
</head>
<body>
<h1>Liste des produits</h1>

<ul>
    @foreach ($products as $product)
        <li style="margin-bottom: 20px;">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="100"><br>
            <strong>{{ $product->name }}</strong><br>
            {{ $product->description }}<br>
            Prix : {{ $product->price }} €<br>
            Catégorie : {{ $product->category->name }}
        </li>
    @endforeach
</ul>
</body>
</html>