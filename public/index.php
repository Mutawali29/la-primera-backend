<?php

error_reporting(E_ALL & ~E_DEPRECATED);

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// --- Fix untuk Vercel serverless: hanya /tmp yang writable ---
if (getenv('VERCEL') || isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');

    $dirs = [
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
    }
}

$app->handleRequest(Request::capture());