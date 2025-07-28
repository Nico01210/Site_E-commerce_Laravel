@extends('layout')

@section('title', 'inscription')

@section('content')
<h1> CREEZ VOTRE COMPTE</h1>

@if($errors->any())
    <div class="alert alert-error">
        <h4>Erreurs dans le formulaire :</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('inscription.submit') }}" method="POST">
    @csrf
    <div class="creation-form">
        <input type="email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
        
        <input type="text" id="nom" placeholder="Nom" name="nom" value="{{ old('nom') }}" required>
        @error('nom')
            <span class="error-message">{{ $message }}</span>
        @enderror
        
        <input type="text" id="prenom" placeholder="Prénom" name="prenom" value="{{ old('prenom') }}" required>
        @error('prenom')
            <span class="error-message">{{ $message }}</span>
        @enderror
        
        <input type="password" id="password" placeholder="Mot de passe" name="password" required>
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
        
        <input type="password" id="password_confirmation" placeholder="Confirmer le mot de passe" name="password_confirmation" required>
    </div>

    <label class="checkbox-label">
      <input type="checkbox" name="accept_terms" value="1" required>
      J'accepte <u>les conditions d'utilisation et la politique de confidentialité</u> de RePlay.
    </label>
    @error('accept_terms')
        <span class="error-message">{{ $message }}</span>
    @enderror

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
  <a href="{{ url('/moncompte') }}" style="text-decoration: underline;">Connectez-vous</a>
</p>




@endsection