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

        // Filtre par catégorie
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        // Filtre par gamme de prix
        if ($request->has('price_range') && !empty($request->price_range)) {
            switch ($request->price_range) {
                case '0-20':
                    $query->whereBetween('price', [0, 20]);
                    break;
                case '20-30':
                    $query->whereBetween('price', [20, 30]);
                    break;
                case '30-50':
                    $query->whereBetween('price', [30, 50]);
                    break;
                case '50+':
                    $query->where('price', '>', 50);
                    break;
            }
        }

        // Filtre par état
        if ($request->has('etat') && !empty($request->etat)) {
            $query->where('etat', $request->etat);
        }

        // Filtre par âge (si vous avez un champ age_min dans votre table)
        if ($request->has('age_range') && !empty($request->age_range)) {
            switch ($request->age_range) {
                case '3-6':
                    $query->whereBetween('age_min', [3, 6]);
                    break;
                case '6-10':
                    $query->whereBetween('age_min', [6, 10]);
                    break;
                case '10-14':
                    $query->whereBetween('age_min', [10, 14]);
                    break;
                case '14+':
                    $query->where('age_min', '>=', 14);
                    break;
            }
        }

        // Tri des résultats
        if ($request->has('sort') && !empty($request->sort)) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'etat_best':
                    $query->orderByRaw("CASE 
                        WHEN etat = 'tres_bon' THEN 1 
                        WHEN etat = 'bon' THEN 2 
                        WHEN etat = 'correct' THEN 3 
                        ELSE 4 END");
                    break;
                case 'etat_worst':
                    $query->orderByRaw("CASE 
                        WHEN etat = 'correct' THEN 1 
                        WHEN etat = 'bon' THEN 2 
                        WHEN etat = 'tres_bon' THEN 3 
                        ELSE 4 END");
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Récupérer toutes les catégories pour le filtre
        $categories = Category::all();

        // Récupérer tous les produits avec pagination
        $products = $query->paginate(12);

        return view('acheter', compact('products', 'categories'));
    }
}
