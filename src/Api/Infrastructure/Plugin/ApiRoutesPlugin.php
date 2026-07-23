<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Plugin;

use App\Api\Infrastructure\Controller\HealthController;
use App\Api\Infrastructure\Controller\HelloController;
use App\Api\Infrastructure\Handler\JsonExceptionHandler;
use App\Api\Infrastructure\Handler\JsonNotFoundHandler;
use App\Api\Infrastructure\Middleware\CorsMiddleware;
use Exception;
use Gacela\Router\Configure\Handlers;
use Gacela\Router\Configure\Middlewares;
use Gacela\Router\Configure\Routes;
use Gacela\Router\Exceptions\NotFound404Exception;
use Gacela\Router\RouterInterface;

final class ApiRoutesPlugin
{
    public function __invoke(RouterInterface $router): void
    {
        $router->configure(static function (Routes $routes, Middlewares $middlewares, Handlers $handlers): void {
            $middlewares->add(CorsMiddleware::class);

            // Return JSON (not empty HTML) for 404s and uncaught errors.
            $handlers->handle(NotFound404Exception::class, JsonNotFoundHandler::class);
            $handlers->handle(Exception::class, JsonExceptionHandler::class);

            # http://localhost:8080/health
            $routes->get('health', HealthController::class);

            # http://localhost:8080/static
            $routes->get('static', HelloController::class, 'staticAction');

            # http://localhost:8080
            # http://localhost:8080/bob
            # http://localhost:8080?name=alice
            $routes->get('{name?}', HelloController::class);
        });
    }
}
