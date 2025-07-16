<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un produit - Backoffice</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="nav-back">
        <ul>
            <li><a href="{{ route('backoffice.produits.index') }}">← Retour aux produits</a></li>
        </ul>
    </nav>

    <main>
        <h1>Créer un nouveau produit</h1>
        
        <div class="backoffice-container">
            <form method="POST" action="{{ route('backoffice.produits.store') }}" class="backoffice-form">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nom du produit</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Prix (€)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" class="form-input" required>
                    @error('price')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="4" class="form-textarea">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" class="form-input" required>
                    @error('stock')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group last">
                    <label for="etat" class="form-label">État</label>
                    <select id="etat" name="etat" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="BON" {{ old('etat') == 'BON' ? 'selected' : '' }}>BON</option>
                        <option value="CORRECT" {{ old('etat') == 'CORRECT' ? 'selected' : '' }}>CORRECT</option>
                        <option value="TRES BON" {{ old('etat') == 'TRES BON' ? 'selected' : '' }}>TRES BON</option>
                    </select>
                    @error('etat')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">Enregistrer le produit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Backoffice - Gestion des produits</p>
    </footer>
</body>
</html>
