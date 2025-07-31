@extends('layout')

@section('title', 'Acheter')

@section('content')
    <h1>JEUX EN VENTE</h1>

<div class="filters-container">
    <form action="{{ route('acheter') }}" method="GET" class="search-form">
        <div class="search-input-container">
            <span><i class="fa fa-search"></i></span>
            <input 
                type="text" 
                name="search" 
                placeholder="Rechercher par nom..."
                class="search-input"
                value="{{ request('search') }}"
            >
        </div>
        <button type="submit" class="search-button">Rechercher</button>
    </form>

    <form action="{{ route('acheter') }}" method="GET" class="filter-form">
        <!-- Conserver la recherche actuelle -->
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
        
        <div class="filtrage_buttons">
            <select name="price_range" onchange="this.form.submit()">
                <option value="">Prix</option>
                <option value="0-20" {{ request('price_range') == '0-20' ? 'selected' : '' }}>0€ - 20€</option>
                <option value="20-30" {{ request('price_range') == '20-30' ? 'selected' : '' }}>20€ - 30€</option>
                <option value="30-50" {{ request('price_range') == '30-50' ? 'selected' : '' }}>30€ - 50€</option>
                <option value="50+" {{ request('price_range') == '50+' ? 'selected' : '' }}>50€+</option>
            </select>

            <select name="etat" onchange="this.form.submit()">
                <option value="">États</option>
                <option value="tres_bon" {{ request('etat') == 'tres_bon' ? 'selected' : '' }}>Très bon</option>
                <option value="bon" {{ request('etat') == 'bon' ? 'selected' : '' }}>Bon</option>
                <option value="correct" {{ request('etat') == 'correct' ? 'selected' : '' }}>Correct</option>
            </select>

            <select name="sort" onchange="this.form.submit()">
                <option value="">Tri par défaut</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nom Z-A</option>
                <option value="etat_best" {{ request('sort') == 'etat_best' ? 'selected' : '' }}>Meilleur état d'abord</option>
                <option value="etat_worst" {{ request('sort') == 'etat_worst' ? 'selected' : '' }}>État le plus usé d'abord</option>
            </select>

            @if(request()->hasAny(['price_range', 'etat', 'sort']))
                <a href="{{ route('acheter') }}" class="btn-reset">Réinitialiser</a>
            @endif
        </div>
    </form>
</div>

<div class="galerie photos">
    @forelse($products as $product)
    <a href="{{ route('produits.show', $product->id) }}" class="photo-item">
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="photo">
            @else
                <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $product->name }}" class="photo">
            @endif
            <p class="photo-caption"><strong>{{ $product->name }}</strong></p>
            @if($product->description)
                <p>{{ $product->description }}</p>
            @endif
            <p>
                @if($product->etat)
                    Etat : {{ strtoupper($product->etat) }} - 
                @endif
                Prix : {{ $product->price }}€
            </p>
            @if($product->category)
                <p class="category">Catégorie : {{ $product->category->name }}</p>
            @endif
        </a>
    @empty
        <div class="no-products">
            <p>Aucun produit trouvé.</p>
            @if(request('search'))
                <p>Essayez avec d'autres mots-clés ou <a href="{{ route('acheter') }}">voir tous les produits</a>.</p>
            @endif
        </div>
    @endforelse
</div>

@if($products->hasPages())
    <div class="pagination-wrapper">
        @include('custom.shop-pagination', ['paginator' => $products->appends(request()->query())])
    </div>
@endif

@endsection 
