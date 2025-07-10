<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Liste des produits</h1>

@if ($products->isEmpty())
    <p style="text-align: center;">Aucun produit disponible.</p>
@else
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }} - {{ $product->price }} €</li>
        @endforeach
    </ul>
@endif
</body>
</html>