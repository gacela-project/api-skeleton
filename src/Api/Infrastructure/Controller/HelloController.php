<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Controller;

use App\Api\Facade;
use Gacela\Framework\DocBlockResolverAwareTrait;
use Gacela\Router\Entities\JsonResponse;
use Gacela\Router\Entities\Request;
use Gacela\Router\Entities\Response;

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

    public function __invoke(string $name = ''): JsonResponse
    {
        $greet = fn (string $n) => $this->getFacade()->greetName($n);

        if ($name !== '') {
            return $this->json($greet($name));
        }

        $requestName = (string)$this->request->get('name');
        if ($requestName !== '') {
            return $this->json($greet($requestName));
        }

        return $this->json('Hello. What is your name? HINT: use the GET param `?name=bob`');
    }

    public function staticAction(): Response
    {
        return new Response('STATIC PAGE');
    }

    private function json(string $greeting): JsonResponse
    {
        return new JsonResponse(
            ['greeting' => $greeting],
            ['Access-Control-Allow-Origin: *'],
        );
    }
}
