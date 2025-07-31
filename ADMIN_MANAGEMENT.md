# 👨‍💼 Gestion des Administrateurs - RePlay

## 🔐 Système d'Administration

Le backoffice de RePlay est maintenant protégé et accessible uniquement aux utilisateurs administrateurs.

## 📋 Fonctionnalités Implémentées

### ✅ Protection du Backoffice
- **Routes protégées** : Toutes les routes `/backoffice/*` et `/admin` nécessitent une authentification admin
- **Middleware personnalisé** : `is_admin` vérifie les droits d'accès
- **Page d'erreur 403** : Affichage personnalisé pour les accès refusés
- **Navigation conditionnelle** : Le lien "Backoffice" n'apparaît que pour les admins

### ✅ Gestion des Utilisateurs Admin
- **Colonne `is_admin`** : Champ boolean dans la table users
- **Méthodes du modèle** : `isAdmin()` et propriété `is_admin`
- **Migration automatique** : Ajout de la colonne dans la base existante

## 🛠️ Commandes Artisan

### Rendre un utilisateur administrateur
```bash
php artisan user:make-admin email@example.com
```

### Retirer les droits admin
```bash
php artisan user:make-admin email@example.com --remove
```

### Lister tous les administrateurs
```bash
php artisan user:list-admins
```

## 🚀 Accès au Backoffice

### Pour les Administrateurs
1. Se connecter avec un compte admin
2. Le lien "Backoffice" apparaît dans la navigation
3. Accès direct via `/backoffice` ou `/admin`

### Pour les Utilisateurs Standards
- Redirection vers page d'erreur 403 personnalisée
- Message explicatif avec liens de retour
- Pas de lien visible dans la navigation

## 👤 Utilisateurs Admin Actuels

Pour voir la liste des administrateurs :
```bash
php artisan user:list-admins
```

Actuellement configurés :
- **Nico** : test1234@gmail.com ✅
- **Test User** : test@example.com ✅

## 🔧 Configuration Technique

### Middleware AdminMiddleware
- **Localisation** : `app/Http/Middleware/AdminMiddleware.php`
- **Alias** : `is_admin` (défini dans `bootstrap/app.php`)
- **Fonctionnement** :
  - Vérifie l'authentification
  - Contrôle la propriété `is_admin` de l'utilisateur
  - Retourne 403 si non autorisé

### Modèle User
- **Propriété** : `is_admin` (boolean, default: false)
- **Méthode** : `isAdmin()` retourne `$this->is_admin`
- **Cast** : Automatique en boolean

### Routes Protégées
```php
// Toutes ces routes nécessitent is_admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', ...);
    Route::get('/backoffice', ...);
    Route::prefix('backoffice')->group(...);
});
```

## 🚨 Sécurité

- ✅ **Double vérification** : Auth + Admin
- ✅ **Page d'erreur personnalisée** : Pas d'exposition des détails techniques
- ✅ **Navigation adaptative** : Liens visibles seulement si autorisé
- ✅ **Gestion des erreurs** : Messages utilisateur-friendly

## 🎯 Tests de Fonctionnement

### Test 1: Utilisateur Non-Admin
1. Se connecter avec un compte utilisateur standard
2. Essayer d'accéder à `/backoffice`
3. **Résultat attendu** : Page 403 avec message explicatif

### Test 2: Utilisateur Admin
1. Se connecter avec un compte admin
2. Voir le lien "Backoffice" dans la navigation
3. Accéder au backoffice sans problème
4. **Résultat attendu** : Accès complet au backoffice

### Test 3: Utilisateur Non-Connecté
1. Essayer d'accéder à `/backoffice` sans être connecté
2. **Résultat attendu** : Redirection vers la page de connexion

## 📝 Notes de Déploiement

Lors du déploiement en production :

1. **Exécuter la migration** :
   ```bash
   php artisan migrate
   ```

2. **Créer le premier admin** :
   ```bash
   php artisan user:make-admin admin@votre-domaine.com
   ```

3. **Vérifier la configuration** :
   ```bash
   php artisan user:list-admins
   ```

## 🔄 Mises à Jour Futures

Pour ajouter d'autres niveaux d'accès :
- Créer des rôles plus granulaires (super-admin, moderateur, etc.)
- Ajouter des permissions spécifiques
- Implémenter des guards Laravel personnalisés

---

✨ **Le backoffice est maintenant sécurisé et accessible uniquement aux administrateurs !** ✨
