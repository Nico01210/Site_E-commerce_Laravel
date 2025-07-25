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
            
            // Debug: Afficher les informations de chemin et permissions
            \Log::info('Upload attempt', [
                'destination' => $destinationPath,
                'exists' => file_exists($destinationPath),
                'writable' => is_writable($destinationPath),
                'base_path' => base_path(),
                'public_path' => public_path()
            ]);
            
            // S'assurer que le dossier existe avec les bonnes permissions
            if (!file_exists($destinationPath)) {
                \Log::info('Création du dossier: ' . $destinationPath);
                if (!mkdir($destinationPath, 0755, true)) {
                    throw new \Exception("Impossible de créer le dossier: " . $destinationPath);
                }
                \Log::info('Dossier créé avec succès');
                
                // Essayer de définir les permissions après création
                try {
                    if (chmod($destinationPath, 0755)) {
                        \Log::info('Permissions 755 définies avec succès');
                    } else {
                        \Log::warning('Échec de chmod 755, tentative avec 777');
                        chmod($destinationPath, 0777);
                    }
                } catch (\Exception $e) {
                    \Log::warning('Erreur chmod: ' . $e->getMessage());
                }
            }
            
            // Vérifier les permissions avant l'upload
            if (!is_writable($destinationPath)) {
                \Log::warning('Dossier non accessible en écriture, tentative de correction');
                
                // Essayer de corriger les permissions avec différentes valeurs
                try {
                    if (chmod($destinationPath, 0755)) {
                        \Log::info('Correction permissions 755 réussie');
                    } elseif (chmod($destinationPath, 0775)) {
                        \Log::info('Correction permissions 775 réussie');
                    } elseif (chmod($destinationPath, 0777)) {
                        \Log::info('Correction permissions 777 réussie');
                    }
                } catch (\Exception $e) {
                    \Log::error('Échec correction permissions: ' . $e->getMessage());
                }
                
                // Vérifier à nouveau
                if (!is_writable($destinationPath)) {
                    \Log::error('Dossier toujours non accessible après correction');
                    \Log::info('Permissions actuelles: ' . substr(sprintf('%o', fileperms($destinationPath)), -4));
                    \Log::info('Propriétaire: ' . fileowner($destinationPath));
                    \Log::info('Utilisateur PHP: ' . get_current_user());
                    throw new \Exception("Le dossier n'est pas accessible en écriture: " . $destinationPath . " (permissions: " . substr(sprintf('%o', fileperms($destinationPath)), -4) . ")");
                }
            }
            
            // Déplacer l'image
            $image->move($destinationPath, $imageName);
            $imagePath = 'images/products/' . $imageName;
            
            \Log::info('Upload successful', ['path' => $imagePath]);
            
        } catch (\Exception $e) {
            \Log::error('Upload failed', ['error' => $e->getMessage()]);
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
            
            // S'assurer que le dossier existe avec les bonnes permissions
            if (!file_exists($destinationPath)) {
                \Log::info('Création du dossier pour update: ' . $destinationPath);
                if (!mkdir($destinationPath, 0755, true)) {
                    throw new \Exception("Impossible de créer le dossier: " . $destinationPath);
                }
                \Log::info('Dossier créé avec succès pour update');
                
                // Essayer de définir les permissions après création
                try {
                    if (chmod($destinationPath, 0755)) {
                        \Log::info('Permissions 755 définies avec succès pour update');
                    } else {
                        \Log::warning('Échec de chmod 755 pour update, tentative avec 777');
                        chmod($destinationPath, 0777);
                    }
                } catch (\Exception $e) {
                    \Log::warning('Erreur chmod pour update: ' . $e->getMessage());
                }
            }
            
            // Vérifier les permissions avant l'upload
            if (!is_writable($destinationPath)) {
                \Log::warning('Dossier non accessible en écriture pour update, tentative de correction');
                
                // Essayer de corriger les permissions avec différentes valeurs
                try {
                    if (chmod($destinationPath, 0755)) {
                        \Log::info('Correction permissions 755 réussie pour update');
                    } elseif (chmod($destinationPath, 0775)) {
                        \Log::info('Correction permissions 775 réussie pour update');
                    } elseif (chmod($destinationPath, 0777)) {
                        \Log::info('Correction permissions 777 réussie pour update');
                    }
                } catch (\Exception $e) {
                    \Log::error('Échec correction permissions pour update: ' . $e->getMessage());
                }
                
                // Vérifier à nouveau
                if (!is_writable($destinationPath)) {
                    \Log::error('Dossier toujours non accessible après correction pour update');
                    \Log::info('Permissions actuelles: ' . substr(sprintf('%o', fileperms($destinationPath)), -4));
                    \Log::info('Propriétaire: ' . fileowner($destinationPath));
                    \Log::info('Utilisateur PHP: ' . get_current_user());
                    throw new \Exception("Le dossier n'est pas accessible en écriture: " . $destinationPath . " (permissions: " . substr(sprintf('%o', fileperms($destinationPath)), -4) . ")");
                }
            }
            
            // Déplacer l'image
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'images/products/' . $imageName;
            
        } catch (\Exception $e) {
            \Log::error('Upload failed in update', ['error' => $e->getMessage()]);
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