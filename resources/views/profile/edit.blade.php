@extends('layout')

@section('title', 'Mon Profil')

@section('content')
    <div class="container">
        <h1>Mon Profil</h1>

        <div class="dashboard-card">
            <h2>Informations du profil</h2>
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="dashboard-card">
            <h2>Changer le mot de passe</h2>
            @include('profile.partials.update-password-form')
        </div>

        <div class="dashboard-card">
            <h2>Supprimer le compte</h2>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
