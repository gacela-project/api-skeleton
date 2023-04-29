<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Route;

use App\Api\Infrastructure\Controller\HelloController;
use Gacela\Framework\Plugin\PluginInterface;
use Gacela\Router\Router;
use Gacela\Router\Routes;

final class ApiRoutesPlugin implements PluginInterface
{
    public function __construct(
        private Router $router,
    ) {
    }

    public function run(): void
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
