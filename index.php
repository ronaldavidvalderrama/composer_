<?php

require_once "vendor/autoload.php";

use App\Middleware\JsonBodyParserMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// Middlewares
//Global -> a todas las Request del Backend

$app->add(function (Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader('Content-Type', 'application/json');
});
// Custom Global Middleware
$app->add(new JsonBodyParserMiddleware());



$app->run();
