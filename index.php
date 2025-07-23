<?php

require_once "vendor/autoload.php";

use App\Middleware\JsonBodyParserMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function (Request $req, Response $res, array $args) {
    $res->getBody()->write(json_encode(["message" => "Hola desde Slim"]));
    return $res;
});
// Middlewares
//Global -> a todas las Request del Backend

$app->add(function (Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader('Content-Type', 'application/json');
});
// Custom Global Middleware
$app->add(new JsonBodyParserMiddleware());


// GET    /campers
// POST   /campers
// PUT    /campers/1
// PATH   /campers/1
// DELETE /campers/1

$app->get("/campers/{name}/{skill}", function (Request $req, Response $res, array $args) {
    // GET    localhost:8081/campers/Adrian/php
    $name = $args["name"];
    $skill = $args["skill"];
    $res->getBody()->write(json_encode([$name, $skill]));
    return $res;
})->add(function (Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader('X-Powered-By', 'Slim Framework');
});

$app->get("/campers", function (Request $req, Response $res, array $args) {
    // GET    localhost:8081/campers?skill=php
    $params = $req->getQueryParams();
    $name = $params["name"] ?? "default";
    $skill = $params["skill"] ?? "default";
    $res->getBody()->write(json_encode([$name, $skill]));
    return $res;
});

$app->post("/campers", function (Request $req, Response $res, array $args) {
    $data = $req->getParsedBody();
    //$res = $res->withStatus(201);
    $res->getBody()->write(json_encode($data));
    return $res->withStatus(201);
    //return $res;
});

$app->run();
