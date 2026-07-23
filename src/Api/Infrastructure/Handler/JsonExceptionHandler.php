<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Handler;

use Exception;
use Gacela\Router\Entities\JsonResponse;

final class JsonExceptionHandler
{
    public function __invoke(Exception $exception): string
    {
        http_response_code(500);

        // Never leak internal exception details to API clients.
        return (string)new JsonResponse(
            ['error' => 'Internal Server Error'],
            ['Access-Control-Allow-Origin: *'],
        );
    }
}
