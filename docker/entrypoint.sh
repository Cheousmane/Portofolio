#!/bin/sh
set -e

# S'assurer qu'un fichier .env existe
if [ ! -f .env ]; then
    touch .env
fi

# Vérification si APP_KEY est valide (doit commencer par base64:)
IS_VALID_KEY=0
if [ -n "$APP_KEY" ]; then
    case "$APP_KEY" in
        base64:*)
            IS_VALID_KEY=1
            ;;
    esac
fi

if [ "$IS_VALID_KEY" -eq 0 ]; then
    echo "=== APP_KEY absente ou non valide. Génération d'une nouvelle clé Laravel... ==="
    php artisan key:generate --force
    GENERATED_KEY=$(grep '^APP_KEY=' .env | cut -d '=' -f2)
    export APP_KEY="$GENERATED_KEY"
    echo "=== Nouvelle clé générée et exportée avec succès ==="
fi

# Nettoyage et mise en cache
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
