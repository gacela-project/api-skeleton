<?php

declare(strict_types=1);

/**
 * Application opcache preload script.
 *
 * Point PHP-FPM at it alongside Gacela's own preload:
 *   env[GACELA_PRELOAD_USER_FILES] = /path/to/project/config/app-preload.php
 *
 * See vendor/gacela-project/gacela/docs/opcache-preload.md
 */
$root = dirname(__DIR__);

// Register the autoloader so compiled classes can link their parents/traits.
require_once $root . '/vendor/autoload.php';

$files = [
    '/src/Api/Facade.php',
    '/src/Api/Factory.php',
    '/src/Api/Config.php',
    '/src/Api/Provider.php',
    '/src/Api/Domain/Greeter.php',
    '/src/Api/Infrastructure/Controller/HealthController.php',
    '/src/Api/Infrastructure/Controller/HelloController.php',
    '/src/Api/Infrastructure/Handler/JsonExceptionHandler.php',
    '/src/Api/Infrastructure/Handler/JsonNotFoundHandler.php',
    '/src/Api/Infrastructure/Middleware/CorsMiddleware.php',
    '/src/Api/Infrastructure/Plugin/ApiRoutesPlugin.php',
];

foreach ($files as $file) {
    opcache_compile_file($root . $file);
}
