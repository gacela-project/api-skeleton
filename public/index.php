<?php

declare(strict_types=1);

use App\Api\Infrastructure\Plugin\ApiRoutesPlugin;
use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Gacela;
use Gacela\Router\Config\RouterGacelaConfig;
use Gacela\Router\Router;

// Resolve from this file, not getcwd() — the web server's working
// directory is the docroot (public/), not the project root.
$appRootDir = \dirname(__DIR__);

/** @psalm-suppress UnresolvableInclude */
require_once $appRootDir . '/vendor/autoload.php';

Gacela::bootstrap($appRootDir, static function (GacelaConfig $config): void {
    $config
        ->enableFileCache()
        ->addAppConfig('app-config.dist.php', 'app-config.php')
        ->extendGacelaConfig(RouterGacelaConfig::class)
        ->addPlugin(ApiRoutesPlugin::class);
});

Gacela::getRequired(Router::class)->run();
