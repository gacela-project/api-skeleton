<?php

declare(strict_types=1);

namespace AppTest\Feature\Api;

use App\Api\Infrastructure\Controller\HealthController;
use PHPUnit\Framework\TestCase;

final class HealthControllerTest extends TestCase
{
    public function test_health_returns_ok_json(): void
    {
        $response = (new HealthController())();

        self::assertSame('{"status":"ok"}', (string)$response);
    }
}
