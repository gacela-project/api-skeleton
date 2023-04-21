<?php

declare(strict_types=1);

namespace App\Api;

use Gacela\Framework\AbstractConfig;

final class Config extends AbstractConfig
{
    public function getApiKey(): string
    {
        return (string)$this->get('api-key');
    }
}
