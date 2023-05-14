<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Plugin;

use App\Api\Infrastructure\Controller\HelloController;
use Gacela\Router\Configure\Routes;
use Gacela\Router\RouterInterface;

final class ApiRoutesPlugin
{
    public function __construct(
        private RouterInterface $router,
    ) {
    }

    public function __invoke(): void
    {
        $this->router->configure(static function (Routes $routes): void {
            # http://localhost:8080/bob
            $routes->get('{name}', HelloController::class);

            # http://localhost:8080
            # http://localhost:8080?name=alice
            $routes->get('/', HelloController::class);
        });
    }
}
