<?php
// Script pour corriger les valeurs d'état des produits
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Correction des valeurs d'état ===\n";

// Vérifier les valeurs actuelles
echo "Valeurs actuelles :\n";
$currentStates = DB::table('products')
    ->select('etat')
    ->selectRaw('COUNT(*) as count')
    ->groupBy('etat')
    ->get();

foreach ($currentStates as $state) {
    echo "- '{$state->etat}' : {$state->count} produits\n";
}

echo "\nCorrection en cours...\n";

// Corriger les valeurs
$updated1 = DB::table('products')->where('etat', 'TRES BON')->update(['etat' => 'tres_bon']);
$updated2 = DB::table('products')->where('etat', 'BON')->update(['etat' => 'bon']);
$updated3 = DB::table('products')->where('etat', 'CORRECT')->update(['etat' => 'correct']);

echo "- Produits 'TRES BON' → 'tres_bon' : {$updated1} modifiés\n";
echo "- Produits 'BON' → 'bon' : {$updated2} modifiés\n";
echo "- Produits 'CORRECT' → 'correct' : {$updated3} modifiés\n";

// Vérifier les nouvelles valeurs
echo "\nNouvelles valeurs :\n";
$newStates = DB::table('products')
    ->select('etat')
    ->selectRaw('COUNT(*) as count')
    ->groupBy('etat')
    ->get();

foreach ($newStates as $state) {
    echo "- '{$state->etat}' : {$state->count} produits\n";
}

echo "\n=== Correction terminée ===\n";
