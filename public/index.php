<?php

declare(strict_types=1);

use App\Api\Infrastructure\Plugin\ApiRoutesPlugin;
use Gacela\Framework\Bootstrap\GacelaConfig;
use Gacela\Framework\Gacela;
use Gacela\Router\Config\RouterGacelaConfig;
use Gacela\Router\Router;

$cwd = (string)getcwd();

require_once $cwd . '/vendor/autoload.php';

Gacela::bootstrap($cwd, static function (GacelaConfig $config): void {
    $config->addAppConfig('app-config.dist.php', 'app-config.php');
    $config->enableFileCache();

    $config->extendGacelaConfig(RouterGacelaConfig::class);
    $config->addPlugin(ApiRoutesPlugin::class);
});

Gacela::get(Router::class)?->run();
