@extends('layout')

@section('title', 'inscription')

@section('content')
<h1> CREEZ VOTRE COMPTE</h1>

@if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="creation-form">
        <input type="email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
        <input type="text" id="nom" placeholder="Nom" name="nom" value="{{ old('nom') }}" required>
        <input type="text" id="prenom" placeholder="Prénom" name="prenom" value="{{ old('prenom') }}" required>
        <input type="password" id="password" placeholder="Mot de passe" name="password" required>
        <input type="password" id="password_confirmation" placeholder="Confirmer le mot de passe" name="password_confirmation" required>
    </div>

    <label class="checkbox-label">
      <input type="checkbox" name="accept_terms" value="1" required>
      J'accepte <u>les conditions d'utilisation et la politique de confidentialité</u> de RePlay.
    </label>

    <button type="submit"><strong>S'inscrire</strong></button>
</form>

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