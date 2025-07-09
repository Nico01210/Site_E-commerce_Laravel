@extends('layout')

@section('title', 'inscription')

@section('content')
<h1> CREEZ VOTRE COMPTE</h1>

<form>

 <div class="creation-form">
     <input type="email" id="email" placeholder="E-mail" name="Email" required>
     <input type="text" id="nom" placeholder="Nom" name="Nom" required>
     <input type="text" id="prénom" placeholder="Prénom" name="Présnom" required>
     <input type="password" id="password" placeholder="Mot de passe" name="password" required>
     <input type="password" id="confirmation" placeholder="Confirmer le mot de passe" name="password-confirm" required>

    </div>
</form>

<label class="checkbox-label">
  <input type="checkbox" name="option1" value="valeur1">
  J'accepte <u>les conditions d'utilisation et la politique de confidentialité</u> de RePlay.
</label>

<button onclick="window.location.href='{{ url('/acheter') }}'"><strong>S'inscrire</strong></button>

<!-- Trait de séparation avec "Ou" -->
<div class="separator">
  <hr>
  <span>Ou</span>
  <hr>
</div>
<button class="google-button" onclick="window.location.href='{{ url('/acheter') }}'">
  <strong>S'inscrire avec Google</strong>
</button>
<p class="inscription">
  Vous avez déjà un compte ? 
  <a href="{{ route('moncompte') }}" style="text-decoration: underline;">Connectez-vous</a>
</p>


@endsection