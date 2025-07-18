<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Afficher la page d'accueil avec les produits populaires
    public function home()
    {
        // Récupérer 4 produits pour la page d'accueil (les plus récents par exemple)
        $featuredProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('home', compact('featuredProducts'));
    }

    // Afficher la liste des produits
    public function index()
    {
        $products = Product::with('category')->get(); // Eager load category
        return view('products.index', compact('products'));
    }



    // Afficher le formulaire de création d’un produit
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }



    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produit ajouté');
    }



    // Afficher un produit spécifique (fiche produit publique)
public function show($id)
{
    $product = Product::with('category')->findOrFail($id);
    
    // Forcer le retour de la vue HTML même si la requête demande du JSON
    return response()->view('product-detail', compact('product'))
        ->header('Content-Type', 'text/html; charset=UTF-8');
}



    // Afficher le formulaire d’édition
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }




    // Mettre à jour un produit existant
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour');
    }




    // Supprimer un produit
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé');
    }




    // Afficher les produits pour la page acheter (publique)
    public function acheter(Request $request)
    {
        $query = Product::with('category');

        // Recherche par nom si un terme est fourni
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Récupérer tous les produits avec pagination
        $products = $query->paginate(12);

        return view('acheter', compact('products'));
    }
}
