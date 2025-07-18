@extends('layout')

@section('title', 'Accueil')

@section('content')
        <img src="{{ asset('images/logo.png') }}" class="full-width" width="100%" alt="Logo">
        <div class="image-para-container">
        <img src="{{ asset('images/para.png') }}" class="full-width" width="100%" alt="Para">
     <div class="texte-sur-image">
Achetez et revendez vos jeux de société en toute simplicité : petits prix pour les passionnés, 
zéro tracas pour les vendeurs.
     </div>
    </div>
    <h1>Nos meilleures ventes</h1>
    <div class="image-row">
        @if($featuredProducts->count() >= 4)
            @foreach($featuredProducts as $product)
                <a href="{{ route('produits.show', $product->id) }}" class="featured-product-link">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="featured-product-image">
                    @else
                        <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $product->name }}" class="featured-product-image">
                    @endif
                    <div class="product-overlay">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->price }}€</p>
                    </div>
                </a>
            @endforeach
        @else
            <!-- Affichage dynamique des produits disponibles ou images par défaut -->
            @forelse($featuredProducts as $product)
                <a href="{{ route('produits.show', $product->id) }}" class="featured-product-link">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="featured-product-image">
                    @else
                        <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $product->name }}" class="featured-product-image">
                    @endif
                    <div class="product-overlay">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->price }}€</p>
                    </div>
                </a>
            @empty
                <!-- Fallback avec images statiques cliquables vers la page d'achat -->
                <a href="{{ route('acheter') }}" class="featured-product-link static-image">
                    <img src="{{ asset('images/crak-list.png') }}" alt="Découvrir nos jeux" class="featured-product-image">
                    <div class="product-overlay">
                        <h3>Découvrir</h3>
                        <p>Nos jeux</p>
                    </div>
                </a>
                <a href="{{ route('acheter') }}" class="featured-product-link static-image">
                    <img src="{{ asset('images/Imagecollée2.png') }}" alt="Voir le catalogue" class="featured-product-image">
                    <div class="product-overlay">
                        <h3>Catalogue</h3>
                        <p>Complet</p>
                    </div>
                </a>
                <a href="{{ route('acheter') }}" class="featured-product-link static-image">
                    <img src="{{ asset('images/Imagecollée3.png') }}" alt="Meilleurs prix" class="featured-product-image">
                    <div class="product-overlay">
                        <h3>Meilleurs</h3>
                        <p>Prix</p>
                    </div>
                </a>
                <a href="{{ route('acheter') }}" class="featured-product-link static-image">
                    <img src="{{ asset('images/Imagecollée4.png') }}" alt="Qualité garantie" class="featured-product-image">
                    <div class="product-overlay">
                        <h3>Qualité</h3>
                        <p>Garantie</p>
                    </div>
                </a>
            @endforelse
        @endif
        <br>
    </div>
<button onclick="window.location.href='{{ url('/acheter') }}'"><strong>Voir tous les jeux</strong></button>

<br>
    <div class="image-icone">
        <img src="{{ asset('images/icone.png') }}" alt="Achat rapide">
        <img src="{{ asset('images/icone2.png') }}" alt="Livraison sécurisée">
        <br>
    </div>
<button onclick="window.location.href='{{ url('/acheter') }}'"><strong>Découvrir notre catalogue</strong></button>

@endsection