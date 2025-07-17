@extends('layout')

@section('title', 'Moncompte')

@section('content')
    <h1>SE CONNECTER</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="conex-form"> 
            <input type="email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
            <input type="password" id="password" placeholder="Mot de passe" name="password" required>
        </div>

        <button type="submit"><strong>Se connecter</strong></button>
    </form>

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