<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Handler;

use Gacela\Router\Entities\JsonResponse;
use Gacela\Router\Exceptions\NotFound404Exception;

final class JsonNotFoundHandler
{
    public function __invoke(NotFound404Exception $exception): string
    {
        http_response_code(404);

        return (string)new JsonResponse(
            ['error' => 'Not Found'],
            ['Access-Control-Allow-Origin: *'],
        );
    }
}
