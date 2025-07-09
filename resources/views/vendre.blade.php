@extends('layout')

@section('title', 'Vendre')

@section('content')
    <h1>VENTE DE JEUX </h1>
    <h2>Le Déroulement</h2>
    <div class="deroulement">
    <p> 1. Remplissez un <strong> court formulaire </strong> sur les jeux que voussouhaitez vendre.</p>
    <p> 2. Nous vous fournissons une <strong>estimation du prix de vente</strong>, si cela vous convient il vous suffit de <strong>valider la vente</strong> et de créer un compte ou de vous connecter.</p>
    <p> 3. Une fois la vente validée, nous vous ferons parvenir un <strong>bon de livraison</strong> par mail et dans votre compte, il vous suffit d’imprimer ce dernier et de <strong>déposer vos jeux</strong> en point relais. On se charge du reste !</p>
    </div>
<div class="btn-container">
    <button onclick="window.location.href='{{ url('/formulaire-vente') }}'">
        <strong>Vendre mes jeux</strong>
    </button>
</div>


    <h2>Programme Qualité</h2>
    <div class="deroulement"><p>Nous effectuons un contrôle des jeux réceptionnés afin de s’assurer de l’état du matériel, à la suite de quoi une note est attribué selon certains critères.
    </p>
</div>
    </div>






    <!-- Ajout des 3 carrés qualité -->
    <div class="carre-container">
        <div class="carre">
            <span class="titre">TRES BON</span><br><br>
            Jeu en excellent état, presque comme neuf, utilisé peu de fois
        </div>
        <div class="carre">
            <span class="titre">BON</span><br><br>
            Jeu utilisé, quelques marques d’usures, aucune pièce manquante
        </div>
        <div class="carre">
            <span class="titre">CORRECT</span><br><br>
            Jeu utilisé, marques d’usures, manque de quelques pièces
        </div>
    </div>




@endsection