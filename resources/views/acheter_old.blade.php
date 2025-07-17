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

  <div class="photo-item">
    <img src="{{ asset('images/limposteur.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>L'imposteur</strong> </p>
        <p>Jeu de bluff rapide et drôle</p>
        <p>Etat : CORRECT -  Prix : 32€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/codenames.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Code Names</strong></p>
        <p>Jeu d’association d’idées</p>
        <p>Etat : BON    -   prix : 25€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/mami.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Mamie Moule Maki</strong></p>
    <p>Jeu de mémoire et de fun</p>
    <p>Etat : CORRECT - Prix 26€ </p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/skyjo.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Skyjo</strong></p>
    <p>Jeu de cartes accessible</p>
    <p>Etat : TRES BON - Prix 35€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/quiritsort.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>LOL qui rit, sort !</strong></p>
    <p>Jeu de stratégie magique</p>
    <p>Etat : BON - Prix 23€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/unomercy.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>UNO No Mercy</strong></p>
    <p>UNO avec une touche piquante</p>
    <p>Etat : BON - Prix 24€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/hues.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Hues And Cues</strong></p>
    <p>Jeu de couleurs et perception</p>
    <p>Etat : CORRECT - Prix 26€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/crak-list.png') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Crack List</strong></p>
    <p>Jeu de société populaire</p>
    <p>Etat : TRES BON - Prix 30€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/mytho.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Mytho Pas Mytho</strong></p>
    <p>Trichez pour gagner… sans vous faire prendre !</p>
    <p>Etat : CORRECT - Prix 26€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/skip-bo.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Skip BO</strong></p>
    <p>Jeu de cartes familial</p>
    <p>Etat : BON - Prix 22€</p> 
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/imposteur2.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>L'imposteur</strong></p>
    <p>Le bluff n’a jamais été aussi drôle</p>
    <p>Etat : CORRECT - Prix 20€</p>
  </div>

  <div class="photo-item">
    <img src="{{ asset('images/wasabi.jpg') }}" alt="Photo jeu" class="photo">
    <p class="photo-caption"><strong>Wazabi</strong></p>
    <p>Créez vos sushis sans vous brûler !</p>
    <p>Etat : TRES BON - Prix 28€</p>
  </div>

</div>



@endsection 