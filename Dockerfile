FROM unit:1.33.0-php8.2

# Instalación de dependencias del sistema y extensiones de PHP
RUN apt update && apt install -y \
    curl unzip git libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql intl zip gd exif ftp bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configuración optimizada de PHP para Producción
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.memory_consumption=256"; \
    echo "opcache.interned_strings_buffer=16"; \
    echo "opcache.max_accelerated_files=20000"; \
    echo "opcache.revalidate_freq=0"; \
    echo "opcache.validate_timestamps=0"; \
    echo "opcache.jit=tracing"; \
    echo "opcache.jit_buffer_size=128M"; \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=64M"; \
    echo "post_max_size=64M"; \
    } > /usr/local/etc/php/conf.d/custom.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/siscor

# Directorios necesarios con permisos correctos
RUN mkdir -p /var/www/siscor/storage /var/www/siscor/bootstrap/cache \
    && chown -R unit:unit /var/www/siscor

# Copiar el código del proyecto
COPY . .

# Instalación de dependencias de Composer (Optimizado para producción)
RUN composer install --prefer-dist --optimize-autoloader --no-interaction --no-dev

# Asegurar permisos después de copiar archivos
RUN chown -R unit:unit /var/www/siscor/storage /var/www/siscor/bootstrap/cache \
    && chmod -R 775 /var/www/siscor/storage /var/www/siscor/bootstrap/cache

# Configuración de NGINX Unit
COPY unit.json /docker-entrypoint.d/unit.json

# PREPARACIÓN PARA PRODUCCIÓN (COOLIFY):
# 1. NO copiamos .env aquí. Coolify inyectará las variables.
# 2. Generamos el link simbólico para los archivos públicos.
RUN php artisan storage:link || true

EXPOSE 8000

CMD ["unitd", "--no-daemon"]
