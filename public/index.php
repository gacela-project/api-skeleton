<?php

declare(strict_types=1);

use App\Api\Infrastructure\Controller\HelloController;
use App\Kernel;
use Gacela\Framework\Gacela;
use Gacela\Router\Router;
use Gacela\Router\Routes;

$cwd = (string)getcwd();

require_once $cwd . '/vendor/autoload.php';

Gacela::bootstrap($cwd, Kernel::gacelaConfigFn());

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

Router::configure(static function (Routes $routes): void {
    # http://localhost:8080/bob
    $routes->get('{name}', HelloController::class);

    # http://localhost:8080
    # http://localhost:8080?name=alice
    $routes->get('/', HelloController::class);
});
