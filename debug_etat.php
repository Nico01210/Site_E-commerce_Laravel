<?php
// Debug script pour vérifier les états des produits
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

echo "=== DEBUG : États des produits ===\n";

$products = Product::select('id', 'name', 'etat')->get();

if ($products->count() == 0) {
    echo "Aucun produit trouvé en base de données.\n";
} else {
    echo "Nombre de produits : " . $products->count() . "\n\n";
    
    foreach ($products as $product) {
        echo "ID: {$product->id} | Nom: {$product->name} | État: '{$product->etat}'\n";
    }
    
    echo "\n=== Comptage par état ===\n";
    $etatCounts = Product::select('etat')
        ->selectRaw('COUNT(*) as count')
        ->groupBy('etat')
        ->get();
    
    foreach ($etatCounts as $count) {
        echo "État '{$count->etat}' : {$count->count} produits\n";
    }
}

echo "\n=== Test de requête avec filtre ===\n";
$testFilter = Product::where('etat', 'tres_bon')->count();
echo "Produits avec état 'tres_bon' : {$testFilter}\n";

$testFilter2 = Product::where('etat', 'bon')->count();
echo "Produits avec état 'bon' : {$testFilter2}\n";

$testFilter3 = Product::where('etat', 'correct')->count();
echo "Produits avec état 'correct' : {$testFilter3}\n";
