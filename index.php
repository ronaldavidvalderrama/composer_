<?php

require_once "vendor/autoload.php";

use App\Infrastructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;

//Variables de .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load(); //$_ENV[...]

//Se carga el Container de PHP-DI
$container = require_once 'bootstrap/container.php';

//Asignamos a Slim el contendor
AppFactory::setContainer($container);

//Iniciar la conexion con la DB
Connection::init();

$app = AppFactory::create();


$container->set(ResponseFactoryInterface::class, $app->getResponseFactory());

//definir quien va a manejar los errores....
$errorHandler = $app->addErrorMiddleware(true,true, true);
$errorHandler->setDefaultErrorHandler($container->get(ErrorHandlerInterface::class));

//Ejecutando los scripts de 
//public/
(require_once 'public/index.php')($app);
//routes/
(require_once 'routes/campers.php')($app);
(require_once 'routes/users.php')($app);

$app->run();