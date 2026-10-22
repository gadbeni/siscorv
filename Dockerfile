# PHP 8.3.36 sobre FrankenPHP (Caddy con PHP adentro), Debian 12 (bookworm).
# Hasta octubre de 2026 corría sobre NGINX Unit con PHP 8.2. Unit se archivó en
# octubre de 2025 y quedó sin parches; PHP 8.3.36 corrige dos fallas críticas de
# ejecución remota de código sin autenticación (CVE-2026-109618 y
# CVE-2026-109619). Para tomar un parche nuevo de PHP se cambia este tag y el
# mínimo de abajo.
FROM dunglas/frankenphp:1.13.2-php8.3.36-bookworm

# La construcción falla si el PHP de la imagen es anterior a 8.3.36.
RUN php -r 'exit(version_compare(PHP_VERSION, "8.3.36", ">=") ? 0 : 1);' \
    || (echo "PHP $(php -r 'echo PHP_VERSION;') es anterior a 8.3.36" && exit 1)

RUN apt update && apt install -y \
    curl unzip git libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql intl zip gd exif ftp bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis

RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.jit=tracing" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.jit_buffer_size=256M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "memory_limit=512M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize=64M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/custom.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/siscor

RUN mkdir -p /var/www/siscor/storage /var/www/siscor/bootstrap/cache

COPY . .

RUN composer install --prefer-dist --optimize-autoloader --no-interaction

COPY .env.example .env
RUN php artisan key:generate

# FrankenPHP corre como `www-data` (no como root): tiene que poder escribir en
# storage, en la caché de Blade y en los directorios de datos de Caddy.
# Sin capacidades en el binario: el puerto 8000 no las necesita, y así arranca
# igual si el orquestador pone `no-new-privileges`.
RUN mkdir -p /data/caddy /config/caddy \
    && chown -R www-data:www-data /var/www/siscor/storage /var/www/siscor/bootstrap/cache /data/caddy /config/caddy \
    && chmod -R 775 /var/www/siscor/storage /var/www/siscor/bootstrap/cache \
    && (setcap -r /usr/local/bin/frankenphp 2>/dev/null || true)

# Caddyfile: puerto 8000, estáticos de public/ y el resto a index.php
# (reemplaza a unit.json).
COPY Caddyfile /etc/frankenphp/Caddyfile

USER www-data

EXPOSE 8000

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
