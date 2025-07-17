<section>
    <form method="post" action="{{ route('profile.update') }}" class="backoffice-form">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="form-label">Nom</label>
            <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @if($errors->get('name'))
                <div class="error-message">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @if($errors->get('email'))
                <div class="error-message">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </div>
    </form>
</section>
