@extends('layout')

@section('title', 'Moncompte')

@section('content')
    <h1>SE CONNECTER</h1>

        <div class="conex-form"> 
            <input type="email" id="email" placeholder="E-mail" name="Email" required>
             <input type="password" id="password" placeholder="Mot de passe" name="password" required>
        </div>

<button onclick="window.location.href='{{ url('/acheter') }}'"><strong>Se connecter</strong></button>


<!-- Lien mot de passe oublié avec une classe -->
<p class="forgot-password">Mot de passe oublié</p>

<!-- Trait de séparation avec "Ou" -->
<div class="separator">
  <hr>
  <span>Ou</span>
  <hr>
</div>
<button class="google-button" onclick="window.location.href='{{ url('/acheter') }}'">
  <strong>Se connecter avec Google</strong>
</button>

<p class="inscription">
  Pas de compte ? 
  <a href="{{ route('inscription') }}" style="text-decoration: underline;">Inscrivez-vous</a>
</p>

@endsection