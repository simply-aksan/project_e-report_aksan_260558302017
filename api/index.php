<?php

// 1. Ensure required temporary writable directories exist in serverless environment
$tmpDirs = [
    '/tmp/views',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app/public',
    '/tmp/bootstrap/cache',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// 2. Setup embedded SQLite database if external DB is not configured
$dbPath = '/tmp/database.sqlite';
$seedDb = __DIR__ . '/../database/seed.sqlite';

if (!file_exists($dbPath)) {
    if (file_exists($seedDb)) {
        @copy($seedDb, $dbPath);
    } else {
        @touch($dbPath);
    }
}

// Set DB environment variables for Vercel if not already set to an external DB
if (empty(getenv('DB_HOST')) && (empty(getenv('DB_CONNECTION')) || getenv('DB_CONNECTION') === 'sqlite')) {
    putenv("DB_CONNECTION=sqlite");
    putenv("DB_DATABASE={$dbPath}");
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = $dbPath;
    $_SERVER['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_DATABASE'] = $dbPath;
}

// 3. Forward request to Laravel public entrypoint
require __DIR__ . '/../public/index.php';
