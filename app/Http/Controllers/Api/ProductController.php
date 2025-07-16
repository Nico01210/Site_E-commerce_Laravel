<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // GET /api/produits
    public function index()
    {
        $produits = Product::with('category')->paginate(10);
        return response()->json($produits);
    }

    // GET /api/produits/{id}
    public function show($id)
    {
        $produit = Product::with('category')->findOrFail($id);
        return response()->json($produit);
    }

    // POST /api/produits
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $produit = Product::create($validated);
        return response()->json($produit, 201);
    }

    // PUT /api/produits/{id}
    public function update(Request $request, $id)
    {
        $produit = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);
        $produit->update($validated);
        return response()->json($produit);
    }

    // DELETE /api/produits/{id}
    public function destroy($id)
    {
        $produit = Product::find($id);
        if (!$produit) {
            return response()->json(['message' => 'Produit non trouvé'], 404);
        }
        $produit->delete();
        return response()->json(['message' => 'Produit supprimé avec succès']);
    }
}
