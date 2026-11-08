#!/usr/bin/env bash
# Exit on error
set -e

echo "=== 1. Install Composer Dependencies ==="
composer install --no-dev --optimize-autoloader

echo "=== 2. Install NPM & Build Vite Assets ==="
npm ci
npm run build

echo "=== 3. Setup SQLite Database ==="
touch database/database.sqlite

echo "=== 4. Run Migrations and Seed Admin ==="
php artisan migrate --force --seed

echo "=== 5. Create Storage Symlink ==="
php artisan storage:link || true

echo "=== Build Complete! ==="
