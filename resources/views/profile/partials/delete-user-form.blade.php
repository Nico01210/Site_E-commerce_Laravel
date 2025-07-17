<section>
    <div class="alert alert-error">
        <p><strong>Attention :</strong> Une fois votre compte supprimé, toutes vos données seront définitivement perdues.</p>
    </div>

    <form method="post" action="{{ route('profile.destroy') }}" class="backoffice-form" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
        @csrf
        @method('delete')

        <div class="form-group">
            <label for="password" class="form-label">Mot de passe (pour confirmation)</label>
            <input id="password" name="password" type="password" class="form-input" placeholder="Entrez votre mot de passe pour confirmer">
            @if($errors->userDeletion->get('password'))
                <div class="error-message">{{ $errors->userDeletion->first('password') }}</div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-danger">Supprimer le compte</button>
            <a href="{{ route('dashboard') }}" class="btn-cancel">Annuler</a>
        </div>
    </form>
</section>
