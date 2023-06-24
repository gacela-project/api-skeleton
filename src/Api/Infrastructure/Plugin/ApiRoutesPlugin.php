<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Plugin;

use App\Api\Infrastructure\Controller\HelloController;
use Gacela\Router\Configure\Routes;
use Gacela\Router\RouterInterface;

final class ApiRoutesPlugin
{
    public function __invoke(RouterInterface $router): void
    {
        $router->configure(static function (Routes $routes): void {
            # http://localhost:8080/static
            $routes->get('static', HelloController::class, 'staticAction');

            # http://localhost:8080
            # http://localhost:8080/bob
            # http://localhost:8080?name=alice
            $routes->get('{name?}', HelloController::class);
        });
    }
}
