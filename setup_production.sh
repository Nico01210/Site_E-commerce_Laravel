#!/bin/bash

# Script de configuration pour le serveur de production
# À exécuter sur le serveur 51.15.253.49

echo "🚀 Configuration du serveur de production Laravel..."

# Variables
LARAVEL_PATH="/var/www/html/Laravel"
IMAGES_PATH="$LARAVEL_PATH/public/images"
PRODUCTS_PATH="$IMAGES_PATH/products"

echo "📁 Chemin Laravel: $LARAVEL_PATH"
echo "🖼️  Chemin images: $IMAGES_PATH"
echo "📦 Chemin products: $PRODUCTS_PATH"

# Vérifier si Laravel existe
if [ ! -d "$LARAVEL_PATH" ]; then
    echo "❌ Erreur: Le dossier Laravel n'existe pas à $LARAVEL_PATH"
    exit 1
fi

echo "✅ Dossier Laravel trouvé"

# Créer le dossier images s'il n'existe pas
if [ ! -d "$IMAGES_PATH" ]; then
    echo "📁 Création du dossier images..."
    sudo mkdir -p "$IMAGES_PATH"
fi

# Créer le dossier products s'il n'existe pas
if [ ! -d "$PRODUCTS_PATH" ]; then
    echo "📦 Création du dossier products..."
    sudo mkdir -p "$PRODUCTS_PATH"
fi

echo "🔧 Configuration des permissions..."

# Définir les permissions appropriées
sudo chown -R www-data:www-data "$LARAVEL_PATH/storage"
sudo chown -R www-data:www-data "$LARAVEL_PATH/bootstrap/cache"
sudo chown -R www-data:www-data "$IMAGES_PATH"

sudo chmod -R 755 "$LARAVEL_PATH/storage"
sudo chmod -R 755 "$LARAVEL_PATH/bootstrap/cache"
sudo chmod -R 755 "$IMAGES_PATH"

echo "📝 Vérification des permissions..."

# Afficher les informations
echo "--- Informations sur $PRODUCTS_PATH ---"
ls -la "$PRODUCTS_PATH" 2>/dev/null || echo "Dossier vide ou inexistant"
ls -ld "$PRODUCTS_PATH"

echo "--- Propriétaire et permissions ---"
stat "$PRODUCTS_PATH" 2>/dev/null || echo "Impossible d'obtenir les stats"

echo "--- Test d'écriture ---"
sudo -u www-data touch "$PRODUCTS_PATH/test_write.txt" 2>/dev/null
if [ -f "$PRODUCTS_PATH/test_write.txt" ]; then
    echo "✅ Test d'écriture réussi"
    sudo rm "$PRODUCTS_PATH/test_write.txt"
else
    echo "❌ Test d'écriture échoué"
fi

echo "🎯 Exécution de la commande Laravel..."
cd "$LARAVEL_PATH"
sudo -u www-data php artisan setup:products-directory

echo "✨ Configuration terminée !"
echo ""
echo "📋 Commandes utiles pour le debug :"
echo "sudo ls -la $PRODUCTS_PATH"
echo "sudo -u www-data touch $PRODUCTS_PATH/test.txt"
echo "curl http://51.15.253.49/diagnostic-permissions"
