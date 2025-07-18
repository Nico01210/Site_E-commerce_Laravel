@extends('layout')

@section('title', $product->name)

@section('content')
    <div class="container">
        <div class="product-detail">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="product-header">
                <h1>{{ $product->name }}</h1>
                <a href="{{ route('acheter') }}" class="btn-back">← Retour à la liste</a>
            </div>

            <div class="product-content">
                <div class="product-image">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image-large">
                    @else
                        <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $product->name }}" class="product-image-large">
                    @endif
                </div>

                <div class="product-info">
                    <div class="product-price">
                        <span class="price">{{ $product->price }}€</span>
                    </div>

                    @if($product->etat)
                        <div class="product-state">
                            <span class="state-label">État :</span>
                            <span class="state-value state-{{ strtolower(str_replace(' ', '-', $product->etat)) }}">
                                {{ strtoupper($product->etat) }}
                            </span>
                        </div>
                    @endif

                    @if($product->category)
                        <div class="product-category">
                            <span class="category-label">Catégorie :</span>
                            <span class="category-value">{{ $product->category->name }}</span>
                        </div>
                    @endif

                    @if($product->description)
                        <div class="product-description">
                            <h3>Description</h3>
                            <p>{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                        </form>
                        <button class="btn btn-secondary">Contacter le vendeur</button>
                    </div>
                </div>
            </div>

            <div class="product-details-extended">
                <h3>Informations détaillées</h3>
                <div class="details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Prix :</span>
                        <span class="detail-value">{{ $product->price }}€</span>
                    </div>
                    @if($product->etat)
                    <div class="detail-item">
                        <span class="detail-label">État :</span>
                        <span class="detail-value">{{ strtoupper($product->etat) }}</span>
                    </div>
                    @endif
                    @if($product->category)
                    <div class="detail-item">
                        <span class="detail-label">Catégorie :</span>
                        <span class="detail-value">{{ $product->category->name }}</span>
                    </div>
                    @endif
                    @if($product->stock)
                    <div class="detail-item">
                        <span class="detail-label">Stock :</span>
                        <span class="detail-value">{{ $product->stock }} disponible(s)</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
