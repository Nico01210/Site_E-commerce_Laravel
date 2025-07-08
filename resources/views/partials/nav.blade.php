<nav>
    <ul>
        <li>
            <a href="/"> 
                <img src="{{ asset('images/petitlogo.png') }}" alt="Logo" style="height: 40px;">
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
        <li>
            <a href="{{ url('/moncompte') }}" class="{{ request()->is('moncompte') ? 'active' : '' }}">Mon compte</a>
        </li>
    </ul>
</nav>
