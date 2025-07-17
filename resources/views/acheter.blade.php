@extends('layout')

@section('title', 'Acheter')

@section('content')
    <h1>JEUX EN VENTE</h1>
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
</form>
<div class="filtrage_buttons">
<button>type</button><button>prix</button><button>état</button><button>âge</button>
<button>nombre</button><button>promo</button>
</div>

<div class="galerie photos">
    @forelse($products as $product)
        <div class="photo-item">
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
        </div>
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
        {{ $products->appends(request()->query())->links() }}
    </div>
@endif

@endsection 
