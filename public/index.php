<?php

declare(strict_types=1);

use App\Api\Infrastructure\Plugin\ApiRoutesPlugin;
use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Gacela;
use Gacela\Router\Config\RouterGacelaConfig;
use Gacela\Router\Router;

$cwd = (string)getcwd();

/** @psalm-suppress UnresolvableInclude */
require_once $cwd . '/vendor/autoload.php';

Gacela::bootstrap($cwd, static function (GacelaConfig $config): void {
    $config
        ->enableFileCache()
        ->addAppConfig('app-config.dist.php', 'app-config.php')
        ->extendGacelaConfig(RouterGacelaConfig::class)
        ->addPlugin(ApiRoutesPlugin::class);
});

Gacela::get(Router::class)?->run();
