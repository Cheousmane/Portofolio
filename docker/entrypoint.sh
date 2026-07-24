#!/bin/sh
set -e

# S'assurer que le fichier .env existe en copiant .env.example si nécessaire
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
    else
        echo "APP_KEY=base64:d13T10bVn6sK4gR9wY2uL8xZ5pM7jN3qF0vH1cE8aI4=" > .env
    fi
fi

# Nettoyage et mise en cache de la configuration
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations de la base de données
php artisan migrate --force

# Créer le lien symbolique vers le stockage
php artisan storage:link || true

# Configurer les permissions pour l'utilisateur Nginx / PHP-FPM (www-data)
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/.env 2>/dev/null || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

# Démarrer PHP-FPM et Nginx via supervisord
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
