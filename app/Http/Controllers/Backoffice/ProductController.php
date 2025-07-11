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
    $products = Product::all();
    return view('backoffice.products.index', compact('products'));
}

// Formulaire de création
public function create()
{
    return view('backoffice.products.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'required|integer',
        'etat' => 'required|string', // <-- obligatoire selon ta table
    ]);

    Product::create($validated);

    return redirect()->route('products.index');
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
    return redirect()->route('products.index');
}

// Supprimer un produit
public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();
    return redirect()->route('products.index');
}




}