@extends('layout')

@section('title', 'Accueil')

@section('content')
        <img src="{{ asset('images/logo.png') }}" width="100%" alt="Logo">
        <div class="image-para-container">
        <img src="{{ asset('images/para.png') }}" width="100%" alt="Para">
     <div class="texte-sur-image">
Achetez et revendez vos jeux de société en toute simplicité : petits prix pour les passionnés, 
zéro tracas pour les vendeurs.
     </div>
    </div>
    <h1>Nos meilleures ventes</h1>
    <div class="image-row">
<img src="{{ asset('images/crak-list.png') }}"  alt="Logo">
<img src="{{ asset('images/Imagecollée2.png') }}" alt="Logo">
<img src="{{ asset('images/Imagecollée3.png') }}" alt="Logo">
<img src="{{ asset('images/Imagecollée4.png') }}" alt="Logo">
<br>
    </div>
<button onclick="window.location.href='{{ url('/acheter') }}'"><strong>Voir tous les jeux</strong></button>

<br>
    <div class="image-icone">

<img src="{{ asset('images/icone.png') }}" alt="Logo">
<img src="{{ asset('images/icone2.png') }}" alt="Logo">
<br>
    </div>
<button onclick="window.location.href='{{ url('/acheter') }}'"><strong>Voir tous les jeux</strong></button>

@endsection