<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Controller;

use App\Api\Facade;
use Gacela\Router\Entities\JsonResponse;
use Gacela\Router\Entities\Request;
use Gacela\Router\Entities\Response;

use function is_string;

final class HelloController
{
    public function __construct(
        private readonly Request $request,
        private readonly Facade $facade,
    ) {
    }

    public function __invoke(string $name = ''): JsonResponse
    {
        if ($name === '') {
            $queryName = $this->request->get('name', '');
            $name = is_string($queryName) ? $queryName : '';
        }

        if ($name === '') {
            return $this->json('Hello. What is your name? HINT: use the GET param `?name=bob`');
        }

        return $this->json($this->facade->greetName($name));
    }

    public function staticAction(): Response
    {
        return new Response('STATIC PAGE');
    }

    private function json(string $greeting): JsonResponse
    {
        return new JsonResponse(['greeting' => $greeting]);
    }
}
