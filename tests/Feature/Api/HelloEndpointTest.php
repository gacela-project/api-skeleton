<?php

declare(strict_types=1);

namespace AppTest\Feature\Api;

use App\Api\Facade;
use Gacela\Framework\Testing\GacelaTestCase;

final class HelloEndpointTest extends GacelaTestCase
{
    protected function setUp(): void
    {
        $this->bootstrapGacelaWithConfig((string)getcwd(), ['api-key' => 'test-key']);
    }

    public function test_facade_greets_name_using_configured_api_key(): void
    {
        $facade = new Facade();

        self::assertSame(
            "Hello, bob! Your secret key is 'test-key'",
            $facade->greetName('bob'),
        );
    }
}
