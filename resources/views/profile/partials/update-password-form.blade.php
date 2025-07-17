<section>
    <form method="post" action="{{ route('password.update') }}" class="backoffice-form">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="form-label">Mot de passe actuel</label>
            <input id="current_password" name="current_password" type="password" class="form-input" autocomplete="current-password">
            @if($errors->updatePassword->get('current_password'))
                <div class="error-message">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input id="password" name="password" type="password" class="form-input" autocomplete="new-password">
            @if($errors->updatePassword->get('password'))
                <div class="error-message">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password">
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="error-message">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </div>
    </form>
</section>
