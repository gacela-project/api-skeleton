<?php

declare(strict_types=1);

namespace App\Api;

use Gacela\Framework\AbstractFacade;

/**
 * @extends AbstractFacade<Factory>
 */
final class Facade extends AbstractFacade
{
    public function greetName(string $name): string
    {
        return $this->getFactory()
            ->createGreeter()
            ->greet($name);
    }
}
