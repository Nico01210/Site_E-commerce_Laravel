@extends('layout')

@section('title', 'Formulaire de Vente')

@section('content')
    <h1>FORMULAIRE DE VENTE</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="deroulement">
        <p>Remplissez ce formulaire pour nous indiquer les jeux que vous souhaitez vendre. Nous vous ferons parvenir une estimation rapidement.</p>
    </div>

    <form action="{{ route('formulaire-vente.submit') }}" method="POST" class="form-vente">
        @csrf

        <div class="form-group">
            <label for="titre">Nom du jeu *</label>
            <input type="text" id="titre" placeholder="Ex: Monopoly, Uno, etc." name="titre" required>
        </div>

        <div class="form-group">
            <label for="etat">État du jeu *</label>
            <select id="etat" name="etat" required>
                <option value="">Sélectionnez l'état</option>
                <option value="TRES BON">TRÈS BON - Excellent état, presque comme neuf</option>
                <option value="BON">BON - Quelques marques d'usures, aucune pièce manquante</option>
                <option value="CORRECT">CORRECT - Marques d'usures, manque de quelques pièces</option>
            </select>
        </div>

        <div class="form-group">
            <label for="langue">Langue</label>
            <input type="text" id="langue" placeholder="Ex: Français, Anglais, etc." name="langue">
        </div>

        <div class="form-group">
            <label for="prix_souhaite">Prix de vente souhaité (€)</label>
            <input type="number" id="prix_souhaite" name="prix_souhaite" min="0" step="0.01" placeholder="Ex: 25.00">
        </div>

        <div class="form-group">
            <label for="description">Description / Commentaires</label>
            <textarea id="description" name="description" rows="4" placeholder="Décrivez l'état du jeu, les éventuelles pièces manquantes, etc."></textarea>
        </div>

        <div class="form-group">
            <label for="contact_nom">Votre nom *</label>
            <input type="text" id="contact_nom" name="contact_nom" required placeholder="Nom et prénom">
        </div>

        <div class="form-group">
            <label for="contact_email">Votre email *</label>
            <input type="email" id="contact_email" name="contact_email" required placeholder="votre@email.com">
        </div>

        <div class="form-actions">
            <button type="submit">Envoyer ma demande d'estimation</button>
            <a href="{{ url('/vendre') }}" class="btn-cancel">Retour</a>
        </div>
    </form>

    <div class="deroulement">
        <h2>Que se passe-t-il après ?</h2>
        <p><strong>1.</strong> Nous analysons votre demande sous 24-48h</p>
        <p><strong>2.</strong> Nous vous envoyons une estimation par email</p>
        <p><strong>3.</strong> Si vous acceptez, nous vous envoyons un bon de livraison</p>
        <p><strong>4.</strong> Vous déposez vos jeux en point relais et nous nous occupons du reste !</p>
    </div>
@endsection