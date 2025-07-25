#!/bin/bash

# Script de correction immédiate des permissions
# À exécuter sur le serveur 51.15.253.49

echo "🔧 Correction immédiate des permissions pour Laravel..."

# Variables
LARAVEL_PATH="/var/www/html/Laravel"
PRODUCTS_PATH="$LARAVEL_PATH/public/images/products"

echo "📍 Vérification de l'existence des dossiers..."

# Créer tous les dossiers nécessaires
echo "📁 Création des dossiers manquants..."
sudo mkdir -p "$PRODUCTS_PATH"

echo "👤 Configuration du propriétaire..."
# Définir www-data comme propriétaire
sudo chown -R www-data:www-data "$LARAVEL_PATH/public/images"

echo "🔐 Configuration des permissions..."
# Définir les permissions appropriées
sudo chmod -R 755 "$LARAVEL_PATH/public/images"

# Permissions spéciales pour le dossier products
sudo chmod 775 "$PRODUCTS_PATH"

echo "✅ Vérification des résultats..."
echo "--- Informations sur $PRODUCTS_PATH ---"
ls -ld "$PRODUCTS_PATH"

echo "--- Test d'écriture en tant que www-data ---"
sudo -u www-data touch "$PRODUCTS_PATH/test_write.txt" 2>&1
if [ -f "$PRODUCTS_PATH/test_write.txt" ]; then
    echo "✅ Test d'écriture RÉUSSI"
    sudo rm "$PRODUCTS_PATH/test_write.txt"
else
    echo "❌ Test d'écriture ÉCHOUÉ"
    echo "Tentative avec permissions 777..."
    sudo chmod 777 "$PRODUCTS_PATH"
    sudo -u www-data touch "$PRODUCTS_PATH/test_write2.txt" 2>&1
    if [ -f "$PRODUCTS_PATH/test_write2.txt" ]; then
        echo "✅ Test avec 777 RÉUSSI"
        sudo rm "$PRODUCTS_PATH/test_write2.txt"
    else
        echo "❌ Même avec 777, ça ne fonctionne pas"
    fi
fi

echo "🌐 Test de la route de diagnostic..."
curl -s http://localhost/diagnostic-permissions | head -20

echo "✨ Script terminé!"
echo ""
echo "🎯 Commandes pour vérifier manuellement:"
echo "sudo ls -la $PRODUCTS_PATH"
echo "sudo -u www-data touch $PRODUCTS_PATH/manual_test.txt"
echo "curl http://51.15.253.49/diagnostic-permissions"
