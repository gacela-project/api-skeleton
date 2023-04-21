<?php

declare(strict_types=1);

namespace App\Api;

use App\Api\Domain\Greeter;
use Gacela\Framework\AbstractFactory;

/**
 * @method Config getConfig()
 */
final class Factory extends AbstractFactory
{
    public function createGreeter(): Greeter
    {
        return new Greeter();
    }
}
