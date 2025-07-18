<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

$count = \App\Models\Product::count();
echo "Nombre de produits: $count\n";

if ($count > 0) {
    $products = \App\Models\Product::take(4)->get(['id', 'name', 'price']);
    foreach ($products as $product) {
        echo "ID: {$product->id} - {$product->name} - {$product->price}€\n";
    }
} else {
    echo "Aucun produit trouvé dans la base de données.\n";
}
