<?php

declare(strict_types=1);

namespace App\Api;

use Gacela\Framework\AbstractConfig;

use function is_string;

final class Config extends AbstractConfig
{
    public function getApiKey(): string
    {
        $apiKey = $this->get('api-key');

        return is_string($apiKey) ? $apiKey : '';
    }
}
