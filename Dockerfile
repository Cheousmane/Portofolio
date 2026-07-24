# ---------- Étape 1 : build des assets front (Vite) ----------
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ---------- Étape 2 : dépendances PHP (Composer) ----------
FROM composer:2 AS vendor
WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-scripts --optimize-autoloader --ignore-platform-reqs

# ---------- Étape 3 : image finale PHP-FPM + Nginx ----------
FROM php:8.3-fpm-alpine

# Extensions PHP nécessaires à Laravel (adapter selon besoin : pdo_pgsql pour Postgres, pdo_mysql pour MySQL)
RUN apk add --no-cache nginx supervisor postgresql-dev libpng-dev libzip-dev icu-dev oniguruma-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring bcmath zip gd intl opcache

WORKDIR /var/www/html

# Copie du code applicatif
COPY . .

# Copie des vendors et des assets construits depuis les étapes précédentes
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

# Config Nginx et Supervisor
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Permissions Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
