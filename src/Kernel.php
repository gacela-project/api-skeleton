<?php

declare(strict_types=1);

namespace App;

use Gacela\Framework\Bootstrap\GacelaConfig;

final class Kernel
{
    /**
     * @return callable(GacelaConfig):void
     */
    public static function gacelaConfigFn(): callable
    {
        return static function (GacelaConfig $config): void {
            $config->addAppConfig('app-config.dist.php', 'app-config.php');
            $config->setFileCacheEnabled(true);
        };
    }
}
