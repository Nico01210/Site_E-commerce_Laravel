@extends('layouts.app')

@section('content')
<h1>Gestion des Produits</h1>


@if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('backoffice.produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix (€)</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    @forelse($produits as $produit)
        <tr>
            <td>
                @if($produit->image)
                    <img src="{{ asset($produit->image) }}" alt="{{ $produit->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                @else
                    <span style="color: #999; font-size: 12px;">Aucune image</span>
                @endif
            </td>
            <td>{{ $produit->name }}</td>
            <td>{{ $produit->description ?? 'Aucune description' }}</td>
            <td>{{ number_format($produit->price, 2, ',', ' ') }}</td>
            <td>
                <a href="{{ route('backoffice.produits.edit', $produit) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('backoffice.produits.destroy', $produit) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Supprimer ce produit ?')" type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">Aucun produit trouvé.</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{-- Si tu utilises la pagination Laravel --}}
@if(method_exists($produits, 'links'))
    <div>
        {{ $produits->links() }}
    </div>
@endif

@endsection
