# PHP 8.3.36 sobre FrankenPHP (Caddy con PHP integrado).
# Antes: NGINX Unit + PHP 8.2. Unit está archivado y sin parches; PHP 8.3.36
# corrige CVE-2026-109618 y CVE-2026-109619 (RCE sin autenticación).
# Para tomar un parche nuevo de PHP basta con cambiar este tag.
FROM dunglas/frankenphp:1.13.3-php8.3.36

RUN apt-get update && apt-get install -y --no-install-recommends curl unzip git \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions pcntl opcache pdo_mysql intl zip gd exif ftp bcmath redis

RUN { \
        echo "opcache.enable=1"; \
        echo "opcache.jit=tracing"; \
        echo "opcache.jit_buffer_size=256M"; \
        echo "memory_limit=512M"; \
        echo "upload_max_filesize=64M"; \
        echo "post_max_size=64M"; \
    } > /usr/local/etc/php/conf.d/custom.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/siscor

RUN mkdir -p /var/www/siscor/storage /var/www/siscor/bootstrap/cache

COPY . .

RUN composer install --prefer-dist --optimize-autoloader --no-interaction

RUN chown -R www-data:www-data /var/www/siscor/storage /var/www/siscor/bootstrap/cache \
    && chmod -R 775 /var/www/siscor/storage /var/www/siscor/bootstrap/cache

COPY Caddyfile /etc/frankenphp/Caddyfile

COPY .env.example .env
RUN php artisan key:generate

EXPOSE 8000

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
