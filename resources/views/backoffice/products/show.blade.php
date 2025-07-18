@extends('layout')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>

    @if($product->image)
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="photo">
    @endif

    <p><strong>Description :</strong> {{ $product->description }}</p>
    <p><strong>Prix :</strong> {{ $product->price }} €</p>
    @if($product->etat)
        <p><strong>État :</strong> {{ strtoupper($product->etat) }}</p>
    @endif
    @if($product->category)
        <p><strong>Catégorie :</strong> {{ $product->category->name }}</p>
    @endif

    <a href="{{ route('acheter') }}">← Retour à la liste</a>
@endsection
