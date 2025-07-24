@extends('layout')

@section('title', 'Mon Profil')

@section('content')
<h1>MON PROFIL</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="dashboard-card">
    <h2>Informations personnelles</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="name">Nom complet :</label>
            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required class="form-input">
        </div>
        
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="form-input">
        </div>
        
        <div class="form-group">
            <label for="role">Statut :</label>
            <input type="text" value="{{ auth()->user()->isAdmin() ? 'Administrateur' : 'Utilisateur' }}" readonly class="form-input" style="background-color: #f5f5f5;">
        </div>
        
        <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
    </form>
</div>

<div class="dashboard-card">
    <h2>Changer le mot de passe</h2>
    <form action="{{ route('profile.password.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="current_password">Mot de passe actuel :</label>
            <input type="password" id="current_password" name="current_password" required class="form-input">
        </div>
        
        <div class="form-group">
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password" required class="form-input">
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirmer le nouveau mot de passe :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="form-input">
        </div>
        
        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
    </form>
</div>

@if(auth()->user()->isAdmin())
<div class="dashboard-card">
    <h2>Accès Administrateur</h2>
    <p>Vous avez les droits d'administrateur. Vous pouvez accéder au tableau de bord admin et au backoffice.</p>
    <div class="admin-buttons">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Tableau de bord Admin</a>
        <a href="{{ url('/backoffice/produits') }}" class="btn btn-primary">Gestion des Produits</a>
    </div>
</div>
@endif

<div class="dashboard-card">
    <h2>Mes commandes</h2>
    <p>Historique de vos achats et commandes.</p>
    <p><em>Fonctionnalité à venir...</em></p>
</div>

<style>
.admin-buttons {
    display: flex;
    gap: 15px;
    margin-top: 15px;
    flex-wrap: wrap;
}

.btn-success {
    background-color: #28a745;
    color: white;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
}

@media (max-width: 768px) {
    .admin-buttons {
        flex-direction: column;
    }
}
</style>

@endsection
