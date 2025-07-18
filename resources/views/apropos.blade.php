@extends('layout')

@section('title', 'Apropos')

@section('content')
    <h1>A propos</h1>

    <div class="apropos-content">
        <!-- Section Team centrée -->
        <div class="team-section">
            <h2>Notre Team</h2>
            <img src="{{ asset('images/team.jpg') }}" alt="Notre team" class="team-image">
        </div>

        <!-- Section Histoire - Image à droite, texte à gauche -->
        <div class="section-alternated section-right">
            <div class="text-content">
                <h2>Notre Histoire</h2>
                <p>🎲 Replay – Le plaisir du jeu, seconde vie incluse ♻️</p>
                <p>Replay est une entreprise engagée dans la revalorisation des jeux de société. Fondée avec la conviction que le jeu doit rester accessible, durable et joyeux, Replay donne une seconde vie aux jeux oubliés en leur offrant une nouvelle maison.</p>
                <p>Notre mission : collecter, tester et revendre des jeux de société de seconde main en parfait état, à des prix abordables, pour tous les passionnés de jeux, familles et curieux.</p>
                <p>🎯 Que ce soit pour redécouvrir des classiques, économiser intelligemment ou consommer de façon plus responsable, Replay allie économie circulaire, convivialité et passion ludique.</p>
            </div>
            <div class="image-content">
                <img src="{{ asset('images/team1.jpeg') }}" alt="Notre histoire" class="section-image">
            </div>
        </div>

        <!-- Section Mission - Image à gauche, texte à droite -->
        <div class="section-alternated section-left">
            <div class="image-content">
                <img src="{{ asset('images/team2.jpeg') }}" alt="Notre mission" class="section-image">
            </div>
            <div class="text-content">
                <h2>Notre Mission</h2>
                <p>🎯 Notre mission chez Replay</p>
                <p>Chez Replay, nous croyons que chaque jeu mérite une seconde chance. Notre mission est simple : donner une nouvelle vie aux jeux de société, tout en rendant le plaisir du jeu accessible à tous et respectueux de la planète.</p>
                <p>Nous collectons des jeux de seconde main, les vérifions avec soin, les remettons en état si besoin, puis les proposons à prix juste sur notre plateforme. En faisant le choix du réemploi, nos clients participent à une démarche éco-responsable, solidaire et ludique.</p>
                <p>Avec Replay, on ne fait pas que rejouer :</p>
                <ul>
                    <li>👉 on partage,</li>
                    <li>👉 on économise,</li>
                    <li>👉 et on préserve.</li>
                </ul>
                <a href="{{ route('formulaire-vente') }}" class="btn btn-primary">Estiimer votre jeu</a>
            </div>
        </div>
    </div>


@endsection