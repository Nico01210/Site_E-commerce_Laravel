<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


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
        'etat' => 'required|in:tres_bon,bon,correct',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Créer une catégorie par défaut si elle n'existe pas
    $defaultCategory = \App\Models\Category::firstOrCreate(
        ['name' => 'Général'],
        [
            'name' => 'Général', 
            'description' => 'Catégorie par défaut',
            'price' => 0,
            'stock' => 0,
            'etat' => 'bon'
        ]
    );

    // Gérer l'upload de l'image
    $imagePath = null;
    if ($request->hasFile('image')) {
        try {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Utiliser le dossier public/images/products
            $destinationPath = public_path('images/products');
            
            // S'assurer que le dossier existe
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Déplacer l'image
            $image->move($destinationPath, $imageName);
            $imagePath = 'images/products/' . $imageName;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['image' => 'Erreur lors de l\'upload de l\'image: ' . $e->getMessage()])->withInput();
        }
    }

    // Valeur par défaut pour stock si non fourni
    $data = [
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'] ?? null,
        'stock' => isset($validated['stock']) ? $validated['stock'] : 0,
        'etat' => $validated['etat'],
        'category_id' => $defaultCategory->id,
        'image' => $imagePath,
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
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'nullable|integer',
        'etat' => 'required|in:tres_bon,bon,correct',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Gérer l'upload de la nouvelle image
    if ($request->hasFile('image')) {
        try {
            // Supprimer l'ancienne image si elle existe
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Utiliser le dossier public/images/products
            $destinationPath = public_path('images/products');
            
            // S'assurer que le dossier existe
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Déplacer l'image
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'images/products/' . $imageName;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['image' => 'Erreur lors de l\'upload de l\'image: ' . $e->getMessage()])->withInput();
        }
    }

    $product->update($validated);
    return redirect()->route('backoffice.produits.index')->with('success', 'Produit mis à jour avec succès !');
}

// Supprimer un produit
public function destroy($id)
{
    $product = Product::findOrFail($id);
    
    // Supprimer l'image si elle existe
    if ($product->image && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }
    
    $product->delete();
    return redirect()->route('backoffice.produits.index')->with('success', 'Produit supprimé avec succès !');
}




}