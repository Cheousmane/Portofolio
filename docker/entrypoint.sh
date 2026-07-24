#!/bin/sh
set -e

# S'assurer que le fichier .env existe en copiant .env.example si nécessaire
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
    else
        touch .env
    fi
fi

# S'assurer que la clé APP_KEY= existe dans .env pour qu'artisan key:generate puisse la remplacer
if ! grep -q '^APP_KEY=' .env; then
    echo "APP_KEY=" >> .env
fi

# Vérification si APP_KEY système est valide (doit commencer par base64:)
IS_VALID_KEY=0
if [ -n "$APP_KEY" ]; then
    case "$APP_KEY" in
        base64:*)
            IS_VALID_KEY=1
            ;;
    esac
fi

if [ "$IS_VALID_KEY" -eq 0 ]; then
    echo "=== APP_KEY absente ou non valide (doit commencer par base64:). Génération d'une nouvelle clé Laravel... ==="
    php artisan key:generate --force
    GENERATED_KEY=$(grep '^APP_KEY=' .env | cut -d '=' -f2)
    export APP_KEY="$GENERATED_KEY"
    echo "=== Clé Laravel générée avec succès ==="
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
