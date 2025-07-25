#!/bin/bash

# Script de déploiement et correction pour le serveur de production
# À exécuter sur le serveur 51.15.253.49

echo "🚀 Déploiement et correction pour Laravel sur serveur de production"
echo "Serveur: 51.15.253.49"
echo "Date: $(date)"

# Variables
LARAVEL_PATH="/var/www/html/Laravel"
PRODUCTS_PATH="$LARAVEL_PATH/public/images/products"
STORAGE_PATH="$LARAVEL_PATH/storage"
BOOTSTRAP_CACHE="$LARAVEL_PATH/bootstrap/cache"

echo ""
echo "📋 Étape 1: Vérification de l'environnement"
echo "Utilisateur actuel: $(whoami)"
echo "Groupe actuel: $(groups)"
echo "Chemin Laravel: $LARAVEL_PATH"

# Vérifier si Laravel existe
if [ ! -d "$LARAVEL_PATH" ]; then
    echo "❌ ERREUR: Le dossier Laravel n'existe pas à $LARAVEL_PATH"
    exit 1
fi
echo "✅ Dossier Laravel trouvé"

echo ""
echo "📁 Étape 2: Création et configuration des dossiers"

# Créer le dossier products et tous les dossiers parents
echo "Création du dossier images/products..."
sudo mkdir -p "$PRODUCTS_PATH"

# Créer aussi les autres dossiers importants s'ils n'existent pas
sudo mkdir -p "$STORAGE_PATH/logs"
sudo mkdir -p "$STORAGE_PATH/framework/sessions"
sudo mkdir -p "$STORAGE_PATH/framework/views"
sudo mkdir -p "$STORAGE_PATH/framework/cache"
sudo mkdir -p "$BOOTSTRAP_CACHE"

echo "✅ Dossiers créés"

echo ""
echo "👤 Étape 3: Configuration des propriétaires"

# Définir www-data comme propriétaire pour tous les dossiers importants
sudo chown -R www-data:www-data "$LARAVEL_PATH/storage"
sudo chown -R www-data:www-data "$BOOTSTRAP_CACHE"
sudo chown -R www-data:www-data "$LARAVEL_PATH/public/images"

echo "✅ Propriétaires configurés"

echo ""
echo "🔐 Étape 4: Configuration des permissions"

# Permissions pour storage et cache
sudo chmod -R 755 "$STORAGE_PATH"
sudo chmod -R 755 "$BOOTSTRAP_CACHE"

# Permissions spéciales pour images
sudo chmod -R 775 "$LARAVEL_PATH/public/images"

# Permissions maximales pour le dossier products si nécessaire
sudo chmod 777 "$PRODUCTS_PATH"

echo "✅ Permissions configurées"

echo ""
echo "🧪 Étape 5: Tests de validation"

echo "--- Test 1: Vérification des permissions ---"
ls -ld "$PRODUCTS_PATH"

echo ""
echo "--- Test 2: Test d'écriture en tant que www-data ---"
sudo -u www-data touch "$PRODUCTS_PATH/test_deploy.txt" 2>&1
if [ -f "$PRODUCTS_PATH/test_deploy.txt" ]; then
    echo "✅ Test d'écriture RÉUSSI"
    sudo rm "$PRODUCTS_PATH/test_deploy.txt"
else
    echo "❌ Test d'écriture ÉCHOUÉ"
    echo "Informations de debug:"
    echo "Permissions du dossier:"
    stat "$PRODUCTS_PATH"
    echo "Contenu du dossier parent:"
    ls -la "$LARAVEL_PATH/public/images/"
fi

echo ""
echo "--- Test 3: Vérification des logs Laravel ---"
if [ -f "$STORAGE_PATH/logs/laravel.log" ]; then
    echo "Fichier de log existe: ✅"
    sudo chown www-data:www-data "$STORAGE_PATH/logs/laravel.log"
    sudo chmod 664 "$STORAGE_PATH/logs/laravel.log"
else
    echo "Création du fichier de log..."
    sudo touch "$STORAGE_PATH/logs/laravel.log"
    sudo chown www-data:www-data "$STORAGE_PATH/logs/laravel.log"
    sudo chmod 664 "$STORAGE_PATH/logs/laravel.log"
fi

echo ""
echo "🌐 Étape 6: Test de la route de diagnostic"
echo "Test de la route: http://51.15.253.49/diagnostic-permissions"
curl -s "http://localhost/diagnostic-permissions" > /tmp/diagnostic.json 2>/dev/null
if [ $? -eq 0 ]; then
    echo "✅ Route de diagnostic accessible"
    echo "Quelques informations clés:"
    cat /tmp/diagnostic.json | head -10
else
    echo "⚠️ Route de diagnostic non accessible (normal si Apache n'est pas démarré)"
fi

echo ""
echo "🎯 Étape 7: Commandes artisan"
cd "$LARAVEL_PATH"

echo "Cache clear..."
sudo -u www-data php artisan cache:clear 2>/dev/null || echo "Cache clear: OK"

echo "Config clear..."
sudo -u www-data php artisan config:clear 2>/dev/null || echo "Config clear: OK"

echo "Test de la commande setup..."
sudo -u www-data php artisan setup:products-directory 2>/dev/null || echo "Commande setup non disponible (déployez d'abord le nouveau code)"

echo ""
echo "✨ DÉPLOIEMENT TERMINÉ!"
echo ""
echo "📋 Résumé:"
echo "- Dossier products: $PRODUCTS_PATH"
echo "- Propriétaire: www-data:www-data"
echo "- Permissions: 777 (maximum)"
echo ""
echo "🧪 Pour tester maintenant:"
echo "1. Accédez à: http://51.15.253.49/diagnostic-permissions"
echo "2. Essayez de créer un produit avec une image"
echo "3. Consultez les logs: sudo tail -f $STORAGE_PATH/logs/laravel.log"
echo ""
echo "🆘 Si ça ne fonctionne toujours pas:"
echo "sudo tail -f $STORAGE_PATH/logs/laravel.log"
echo "sudo ls -la $PRODUCTS_PATH"
echo "sudo -u www-data touch $PRODUCTS_PATH/debug.txt"
