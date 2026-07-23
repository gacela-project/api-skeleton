<?php

declare(strict_types=1);

namespace App\Api;

use Gacela\Framework\AbstractProvider;
use Gacela\Framework\Container\Container;
use Override;

/**
 * @extends AbstractProvider<Config>
 */
final class Provider extends AbstractProvider
{
    #[Override]
    public function provideModuleDependencies(Container $container): void
    {
    }
}
