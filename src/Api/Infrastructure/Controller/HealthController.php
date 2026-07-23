<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Controller;

use Gacela\Router\Entities\JsonResponse;

final class HealthController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
