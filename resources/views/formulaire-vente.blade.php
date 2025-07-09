@extends('layout')

@section('title', 'formulaire-vente')

@section('content')
<h1>FORMULAIRE DE VENTE </h1>

    <form action="{{ route('vente.submit') }}" method="POST" class="form-vente">
        @csrf

        <div class="form-group">
            <input type="text" id="titre" placeholder="Titre du jeu" name="titre" required>
        </div>

        <div class="form-group">
            <input type="text" placeholder="État général du jeu" id="etat" name="etat" required>
        </div>

        <div class="form-group">
            <input type="text" id="langue" placeholder="Langue" name="langue" required>
        </div>

        <button type="submit">Envoyer ma demande d'estimation</button>
    </form>
@endsection