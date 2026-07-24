#!/bin/sh
set -e

# Génère APP_KEY si absent (sécurité, normalement déjà défini sur Railway)
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache config/routes/vues pour la prod (ignoré si déjà en cache)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations
php artisan migrate --force

# Lien storage (idempotent)
php artisan storage:link || true

# Démarre PHP-FPM + Nginx via supervisord
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
