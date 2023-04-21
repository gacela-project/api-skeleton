<?php

declare(strict_types=1);

namespace AppTest\Unit\Api\Domain;

use App\Api\Domain\Greeter;
use PHPUnit\Framework\TestCase;

final class GreeterTest extends TestCase
{
    public function test_greet(): void
    {
        $greeter = new Greeter();
        $actual = $greeter->greet('name');

        self::assertSame('Hello, name!', $actual);
    }
}
