#!/bin/sh
set -e

# S'assurer qu'un fichier .env existe
if [ ! -f .env ]; then
    touch .env
fi

# Si APP_KEY est absent des variables d'environnement système
if [ -z "$APP_KEY" ]; then
    KEY_IN_ENV=$(grep '^APP_KEY=' .env | cut -d '=' -f2 2>/dev/null || true)
    if [ -z "$KEY_IN_ENV" ]; then
        php artisan key:generate --force
    fi
    export APP_KEY=$(grep '^APP_KEY=' .env | cut -d '=' -f2)
fi

# Recharger proprement la configuration
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations
php artisan migrate --force

# Lien de stockage
php artisan storage:link || true

# Lancer supervisord
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
