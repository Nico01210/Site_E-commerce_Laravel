<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    
// Afficher tous les produits
public function index()
{
    $produits = \App\Models\Product::with('category')->paginate(10);
    return view('backoffice.products.index', compact('produits'));
}
// Formulaire de création
public function create()
{
    $categories = \App\Models\Category::all();
    return view('backoffice.products.create', compact('categories'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'nullable|integer',
        'etat' => 'required|in:BON,CORRECT,TRES BON',
    ]);

    // Créer une catégorie par défaut si elle n'existe pas
    $defaultCategory = \App\Models\Category::firstOrCreate(
        ['name' => 'Général'],
        [
            'name' => 'Général', 
            'description' => 'Catégorie par défaut', 
            'price' => 0,
            'stock' => 0,
            'etat' => 'BON'
        ]
    );

    // Valeur par défaut pour stock si non fourni
    $data = [
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'] ?? null,
        'stock' => isset($validated['stock']) ? $validated['stock'] : 0,
        'etat' => $validated['etat'],
        'category_id' => $defaultCategory->id,
    ];

    Product::create($data);

    return redirect()->route('backoffice.produits.index')->with('success', 'Produit créé avec succès !');
}

// Afficher un produit
public function show($id)
{
    $product = Product::findOrFail($id);
    return view('backoffice.products.show', compact('product'));
}

// Formulaire d’édition
public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('backoffice.products.edit', compact('product'));
}

// Mettre à jour un produit
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $product->update($request->all());
    return redirect()->route('backoffice.produits.index')->with('success', 'Produit mis à jour avec succès !');
}

// Supprimer un produit
public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();
    return redirect()->route('backoffice.produits.index')->with('success', 'Produit supprimé avec succès !');
}




}