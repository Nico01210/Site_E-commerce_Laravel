<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <div>
        <label for="name">Nom du produit</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="price">Prix (€)</label><br>
        <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0">
        @error('price')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description">Description</label><br>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        @error('description')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="stock">Stock</label><br>
        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0">
        @error('stock')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="etat">État</label><br>
        <input type="text" id="etat" name="etat" value="{{ old('etat') }}">
        @error('etat')
            <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Enregistrer le produit</button>
</form>
