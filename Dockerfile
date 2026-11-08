FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_sqlite pcntl bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application files (including pre-built public/build)
COPY . .

# Run composer with scripts disabled first to prevent any artisan crash, then dump-autoload
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts \
    && touch database/database.sqlite \
    && chmod -R 777 storage bootstrap/cache database

ENV PORT=8080
EXPOSE 8080

CMD php artisan package:discover --ansi && php artisan migrate --force --seed && (php artisan storage:link || true) && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
