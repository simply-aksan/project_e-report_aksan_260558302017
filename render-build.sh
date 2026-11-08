#!/usr/bin/env bash
# Exit on error
set -e

echo "=== 1. Download & Setup Composer ==="
if ! command -v composer &> /dev/null; then
    EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

    if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
        >&2 echo 'ERROR: Invalid installer checksum'
        rm composer-setup.php
        exit 1
    fi

    php composer-setup.php --quiet
    rm composer-setup.php
    COMPOSER_BIN="php composer.phar"
else
    COMPOSER_BIN="composer"
fi

echo "=== 2. Install Composer Dependencies ==="
$COMPOSER_BIN install --no-dev --optimize-autoloader

echo "=== 3. Install NPM & Build Vite Assets ==="
npm ci
npm run build

echo "=== 4. Setup SQLite Database ==="
touch database/database.sqlite

echo "=== 5. Run Migrations and Seed Admin ==="
php artisan migrate --force --seed

echo "=== 6. Create Storage Symlink ==="
php artisan storage:link || true

echo "=== Build Complete! ==="
