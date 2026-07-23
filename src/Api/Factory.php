<?php

declare(strict_types=1);

namespace App\Api;

use App\Api\Domain\Greeter;
use Gacela\Framework\AbstractFactory;

/**
 * @extends AbstractFactory<Config>
 */
final class Factory extends AbstractFactory
{
    public function createGreeter(): Greeter
    {
        return new Greeter(
            $this->getConfig()->getApiKey(),
        );
    }
}
