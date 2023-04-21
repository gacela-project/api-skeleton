<?php

declare(strict_types=1);

namespace App\Api\Domain;

final class Greeter
{
    public function __construct(
        private string $apiKey,
    ) {
    }

    public function greet(string $name): string
    {
        return "Hello, {$name}! Your secret key is '{$this->apiKey}'";
    }
}
