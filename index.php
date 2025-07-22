<?php

require_once "vendor/autoload.php";

use App\Middleware\JsonBodyParserMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

header('Content-Type: application/json');

$app->get('/', function(Request $req, Response $res, array $args) {
    $res->getBody()->write(json_encode(["message" => "hola desde Slim"]));
    return $res;
});

//middleware
//global > a todas las request del backend

$app->add(function(Request $req, Handler $han): Response {
    $response = $han->handle($req);
    return $response->withHeader('Content-Type', 'application/json');   
});

// custom Global Middleware
$app->add(new JsonBodyParserMiddleware());








// GET    / campers
// POST   / campers
// PUT    / campers/1
// PATCH  / campers/1
// DELETE / campers/1

$app->get("/campers/{name}/{skill}", function(Request $req, Response $res, array $args) {
    // GET localhost:8081/campers/Adrian/php
    $name = $args["name"] ?? "default";
    $skill = $args["skill"] ?? "default";
    $res->getBody()->write(json_encode([$name, $skill]));
    return $res;
})->add(function(Request $req, Handler $han): Response {
    $reponse = $han->handle($req);
    return $reponse->withHeader('x-powered-By', 'Slim framework');
});

$app->get("/campers", function(Request $req, Response $res, array $args) {
    // GET localhost:8081/campers?name=Adrian&php=php
    $params = $req->getQueryParams();
    $name = $params["name"] ?? "default";
    $skill = $params["skill"] ?? "default";
    $res->getBody()->write(json_encode([$name, $skill]));
    return $res;
});

$app->post("/campers", function(Request $req, Response $res, array $args) {
    $data = $req->getParsedBody();
    var_dump($data['name'] ?? 'Desconocido :(');
    //$res->withStatus(201);
    $res->getBody()->write(json_encode($data));
    return $res->withStatus(201);
});

$app->run();

