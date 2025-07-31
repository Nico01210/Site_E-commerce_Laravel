<nav>
    <!-- Logo centré -->
    <div class="navbar-brand">
        <a href="/"> 
            <img src="{{ asset('images/petitlogo.png') }}" alt="Logo" class="logo">
        </a>
    </div>

    <!-- Menu burger (visible sur mobile/tablette) -->
    <div class="burger-menu" onclick="toggleMobileMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Menu desktop (caché sur mobile/tablette) -->
    <ul>
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
            <a href="{{ route('profile.edit') }}" class="{{ request()->is('profil') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Mon profil
            </a>
        </li>
        @if(auth()->user()->is_admin)
        <li>
            <a href="{{ url('/backoffice') }}" class="{{ request()->is('backoffice*') ? 'active' : '' }}">
                <i class="fas fa-cogs"></i> Backoffice
            </a>
        </li>
        @endif
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

    <!-- Menu mobile overlay -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li>
                <a href="/" onclick="closeMobileMenu()">Accueil</a>
            </li>
            <li>
                <a href="{{ url('/acheter') }}" onclick="closeMobileMenu()">Acheter</a>
            </li>
            <li>
                <a href="{{ url('/vendre') }}" onclick="closeMobileMenu()">Vendre</a>
            </li>
            <li>
                <a href="{{ url('/apropos') }}" onclick="closeMobileMenu()">À propos</a>
            </li>
            @auth
            <li>
                <a href="{{ route('cart.show') }}" onclick="closeMobileMenu()">
                    <i class="fas fa-shopping-cart"></i> Panier 
                    <span class="cart-count">{{ $cartItemsCount ?? 0 }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}" onclick="closeMobileMenu()">
                    <i class="fas fa-user"></i> Mon profil
                </a>
            </li>
            @if(auth()->user()->is_admin)
            <li>
                <a href="{{ url('/backoffice') }}" onclick="closeMobileMenu()">
                    <i class="fas fa-cogs"></i> Backoffice
                </a>
            </li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-logout-btn" onclick="closeMobileMenu()">Déconnexion</button>
                </form>
            </li>
            @else
            <li>
                <a href="{{ url('/moncompte') }}" onclick="closeMobileMenu()">Mon compte</a>
            </li>
            @endauth
        </ul>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const burgerMenu = document.querySelector('.burger-menu');
    
    mobileMenu.classList.toggle('active');
    burgerMenu.classList.toggle('active');
    
    // Empêche le scroll du body quand le menu est ouvert
    if (mobileMenu.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = 'auto';
    }
}

function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const burgerMenu = document.querySelector('.burger-menu');
    
    mobileMenu.classList.remove('active');
    burgerMenu.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Ferme le menu si on clique en dehors
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const burgerMenu = document.querySelector('.burger-menu');
    
    if (mobileMenu.classList.contains('active') && 
        !mobileMenu.contains(event.target) && 
        !burgerMenu.contains(event.target)) {
        closeMobileMenu();
    }
});
</script>
