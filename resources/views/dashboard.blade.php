@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        
        <div class="dashboard-card">
            <h2>Bienvenue, {{ Auth::user()->name }} !</h2>
            
            <p>Vous êtes connecté en tant que : <strong>{{ Auth::user()->email }}</strong></p>

            <p style="margin-top: 20px;">Accès rapide :</p>
            <ul>
                <li><a href="/backoffice/produits">Gérer les produits</a></li>
                <li><a href="{{ route('profile.edit') }}">Mon profil</a></li>
                <li><a href="/">Retour au site</a></li>
            </ul>
        </div>
    </div>
@endsection