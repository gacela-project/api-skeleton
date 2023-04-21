<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Controller;

use App\Api\Facade;
use Gacela\Framework\DocBlockResolverAwareTrait;
use Gacela\Router\Entities\Request;

/**
 * @method Facade getFacade()
 */
final class HelloController
{
    use DocBlockResolverAwareTrait;

    public function __construct(
        private Request $request,
    ) {
    }

    public function __invoke(string $name = ''): string
    {
        if ($name !== '') {
            return $this->getFacade()->greetName($name);
        }

        $requestName = (string)$this->request->get('name');
        if ($requestName !== '') {
            return $this->getFacade()->greetName($requestName);
        }

        return 'Hello. What is your name? HINT: use the GET param `?name=bob`';
    }
}
