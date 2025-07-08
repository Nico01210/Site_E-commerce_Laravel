@extends('layout')

@section('title', 'Acheter')

@section('content')
    <h1>Jeux en vente</h1>
<form action="{{ url('/acheter') }}" method="GET" class="search-form">
    <div class="search-input-container">
        <span><i class="fa fa-search"></i></span>
        <input 
            type="text" 
            name="search" 
            placeholder="Rechercher par nom..."
            class="search-input"
        >
    </div>
</form>
    <p>Bienvenue sur la page d’achat.</p>



@endsection 