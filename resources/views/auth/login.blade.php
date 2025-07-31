@extends('layout')

@section('title', 'Connexion')

@section('content')
<h1>CONNEXION</h1>

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error">
        <h4>Erreurs de connexion :</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="creation-form">
        <input type="email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
        
        <input type="password" id="password" placeholder="Mot de passe" name="password" required>
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <label class="checkbox-label">
        <input type="checkbox" name="remember" value="1">
        Se souvenir de moi
    </label>

    <button type="submit"><strong>Se connecter</strong></button>
</form>

<!-- Trait de séparation avec "Ou" -->
<div class="separator">
    <hr>
    <span>Ou</span>
    <hr>
</div>

<button class="google-button" onclick="window.location.href='{{ route('register') }}'">
    <strong>Créer un compte</strong>
</button>

<p class="inscription">
    <a href="{{ route('password.request') }}" style="text-decoration: underline;">Mot de passe oublié ?</a>
</p>

@endsection
