<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Backoffice')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <img src="{{ asset('images/petitlogo.png') }}" alt="Logo" class="logo">
            </div>
            <ul class="navbar-nav">
                <li><a href="{{ route('backoffice.produits.index') }}">Liste des produits</a></li>
                <li><a href="{{ route('backoffice.produits.create') }}">Ajouter un produit</a></li>
                <li><a href="{{ url('/') }}">Retour au site</a></li>
                @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: white; text-decoration: underline; cursor: pointer; font-size: inherit;">Déconnexion</button>
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; 2025 Backoffice. Tous droits réservés.</p>
    </footer>
</body>
</html>
