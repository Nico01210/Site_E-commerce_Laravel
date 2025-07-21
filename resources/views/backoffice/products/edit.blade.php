<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit - Backoffice</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="nav-back">
        <ul>
            <li><a href="{{ route('backoffice.produits.index') }}">← Retour aux produits</a></li>
        </ul>
    </nav>

    <main>
        <h1>Modifier le produit</h1>
        
        <div class="backoffice-container">
            <form action="{{ route('backoffice.produits.update', $product->id) }}" method="POST" class="backoffice-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name" class="form-label">Nom du produit</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-input" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Prix (€)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" class="form-input" required>
                    @error('price')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="4" class="form-textarea">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="form-input" required>
                    @error('stock')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Image du produit</label>
                    @if($product->image)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset($product->image) }}" alt="Image actuelle" style="max-width: 200px; height: auto; border-radius: 5px;">
                            <p style="font-size: 12px; color: #666;">Image actuelle</p>
                        </div>
                    @endif
                    <input type="file" id="image" name="image" accept="image/*" class="form-input">
                    <p style="font-size: 12px; color: #666;">Laisser vide pour conserver l'image actuelle</p>
                    @error('image')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group last">
                    <label for="etat" class="form-label">État</label>
                    <select id="etat" name="etat" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="tres_bon" {{ old('etat', $product->etat) == 'tres_bon' ? 'selected' : '' }}>Très bon</option>
                        <option value="bon" {{ old('etat', $product->etat) == 'bon' ? 'selected' : '' }}>Bon</option>
                        <option value="correct" {{ old('etat', $product->etat) == 'correct' ? 'selected' : '' }}>Correct</option>
                    </select>
                    @error('etat')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit">Mettre à jour le produit</button>
                    <a href="{{ route('backoffice.produits.index') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Backoffice - Gestion des produits</p>
    </footer>
</body>
</html>
