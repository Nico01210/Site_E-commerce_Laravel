@extends('layout')

@section('title', 'Accès refusé')

@section('content')
<div style="text-align: center; padding: 50px 20px;">
    <h1 style="color: #721c24; font-size: 48px; margin-bottom: 20px;">🚫</h1>
    <h2 style="color: #721c24; margin-bottom: 20px;">Accès refusé</h2>
    <p style="font-size: 18px; margin-bottom: 30px; color: #666;">
        Vous n'avez pas les permissions nécessaires pour accéder à cette page.
    </p>
    <p style="font-size: 16px; margin-bottom: 30px; color: #666;">
        Seuls les administrateurs peuvent accéder au backoffice.
    </p>
    
    <div style="margin: 30px 0;">
        <a href="{{ url('/') }}" class="btn btn-primary" style="
            display: inline-block;
            padding: 12px 30px;
            background-color: #400F10;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 0 10px;
        ">
            🏠 Retour à l'accueil
        </a>
        
        @if(Auth::check())
            <a href="{{ url('/profil') }}" class="btn btn-secondary" style="
                display: inline-block;
                padding: 12px 30px;
                background-color: #8B0000;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                margin: 0 10px;
            ">
                👤 Mon profil
            </a>
        @else
            <a href="{{ url('/moncompte') }}" class="btn btn-secondary" style="
                display: inline-block;
                padding: 12px 30px;
                background-color: #8B0000;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                margin: 0 10px;
            ">
                🔐 Se connecter
            </a>
        @endif
    </div>

    @if(Auth::check())
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin: 20px auto; max-width: 500px;">
            <p style="margin: 0; color: #666; font-size: 14px;">
                <strong>Utilisateur connecté :</strong> {{ Auth::user()->name }}
                <br>
                <strong>Statut :</strong> {{ Auth::user()->is_admin ? 'Administrateur' : 'Utilisateur standard' }}
            </p>
        </div>
    @endif
</div>
@endsection
