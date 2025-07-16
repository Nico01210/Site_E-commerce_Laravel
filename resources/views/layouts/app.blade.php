<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Backoffice')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Ajouter Bootstrap ou autre CSS/JS -->
</head>
<body>
    <header>
        <nav>
            <!-- Ton menu backoffice -->
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>