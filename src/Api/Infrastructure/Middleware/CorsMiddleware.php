<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Middleware;

use Closure;
use Gacela\Router\Entities\Request;
use Gacela\Router\Middleware\MiddlewareInterface;
use Override;

final class CorsMiddleware implements MiddlewareInterface
{
    #[Override]
    public function handle(Request $request, Closure $next): string
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        return (string)$next($request);
    }
}
