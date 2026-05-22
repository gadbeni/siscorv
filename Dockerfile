FROM unit:1.33.0-php8.2

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl unzip git libicu-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pcntl opcache pdo pdo_mysql intl zip gd exif ftp bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN { \
        echo "opcache.enable=1"; \
        echo "opcache.enable_cli=1"; \
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
        echo "max_execution_time=300"; \
    } > /usr/local/etc/php/conf.d/custom.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/siscor

RUN mkdir -p /var/www/siscor/storage /var/www/siscor/bootstrap/cache

# Copy composer files for caching
COPY composer.json composer.lock* ./

# Install dependencies without scripts and autoloader
RUN composer install --prefer-dist --no-scripts --no-autoloader --no-interaction

# Copy application files
COPY . .

# Run full composer install to generate optimized autoloader and run scripts
RUN composer install --prefer-dist --optimize-autoloader --no-interaction

RUN chown -R unit:unit /var/www/siscor/storage /var/www/siscor/bootstrap/cache \
    && chmod -R 775 /var/www/siscor/storage /var/www/siscor/bootstrap/cache

COPY unit.json /docker-entrypoint.d/unit.json

COPY .env.example .env
RUN php artisan key:generate

EXPOSE 8000

CMD ["unitd", "--no-daemon"]
