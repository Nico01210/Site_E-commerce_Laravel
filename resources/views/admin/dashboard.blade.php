@extends('layout')

@section('title', 'Tableau de bord Admin')

@section('content')
<div class="admin-dashboard">
    <h1>TABLEAU DE BORD ADMINISTRATEUR</h1>
    
    <div class="admin-stats">
        <div class="stat-card">
            <h3>Produits</h3>
            <p class="stat-number">{{ App\Models\Product::count() }}</p>
            <a href="{{ route('backoffice.produits.index') }}" class="btn btn-primary">Gérer les produits</a>
        </div>
        
        <div class="stat-card">
            <h3>Utilisateurs</h3>
            <p class="stat-number">{{ App\Models\User::count() }}</p>
            <a href="#" class="btn btn-primary">Gérer les utilisateurs</a>
        </div>
        
        <div class="stat-card">
            <h3>Catégories</h3>
            <p class="stat-number">{{ App\Models\Category::count() }}</p>
            <a href="#" class="btn btn-primary">Gérer les catégories</a>
        </div>
    </div>

    <div class="quick-actions">
        <h2>Actions rapides</h2>
        <div class="action-buttons">
            <a href="{{ route('backoffice.produits.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter un produit
            </a>
            <a href="{{ route('backoffice.produits.index') }}" class="btn btn-info">
                <i class="fas fa-list"></i> Voir tous les produits
            </a>
            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
                <i class="fas fa-user"></i> Mon profil
            </a>
        </div>
    </div>
</div>

<style>
.admin-dashboard {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.admin-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin: 30px 0;
}

.stat-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-card h3 {
    margin: 0 0 10px 0;
    color: #495057;
}

.stat-number {
    font-size: 2em;
    font-weight: bold;
    color: #007bff;
    margin: 10px 0;
}

.quick-actions {
    margin-top: 40px;
}

.action-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.btn {
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background-color: #007bff;
    color: white;
}

.btn-success {
    background-color: #28a745;
    color: white;
}

.btn-info {
    background-color: #17a2b8;
    color: white;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .action-buttons {
        flex-direction: column;
    }
    
    .btn {
        text-align: center;
        justify-content: center;
    }
}
</style>
@endsection
