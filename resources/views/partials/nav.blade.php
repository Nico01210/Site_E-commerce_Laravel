<nav>
    <ul>
        <li>
            <a href="/"> 
                <img src="{{ asset('images/petitlogo.png') }}" alt="Logo" class="logo">
            </a>
        </li>
        <li>
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Accueil</a>
        </li>
        <li>
            <a href="{{ url('/acheter') }}" class="{{ request()->is('acheter') ? 'active' : '' }}">Acheter</a>
        </li>
        <li>
            <a href="{{ url('/vendre') }}" class="{{ request()->is('vendre') ? 'active' : '' }}">Vendre</a>
        </li>
        <li>
            <a href="{{ url('/apropos') }}" class="{{ request()->is('apropos') ? 'active' : '' }}">À propos</a>
        </li>
        @auth
        <li>
            <a href="{{ route('cart.show') }}" class="{{ request()->is('panier') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> Panier 
                <span class="{{ ($cartItemsCount ?? 0) > 0 ? 'cart-count' : 'cart-count-zero' }}">
                    ({{ $cartItemsCount ?? 0 }})
                </span>
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-logout-btn">Déconnexion</button>
            </form>
        </li>
        @else
        <li>
            <a href="{{ url('/moncompte') }}" class="{{ request()->is('moncompte') ? 'active' : '' }}">Mon compte</a>
        </li>
        @endauth
    </ul>
</nav>
