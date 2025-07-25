<?php

require_once "vendor/autoload.php";

use App\Infrastructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;


//variable de .env
$dotenv = Dotenv::createImmutable(__DIR__. '/');
$dotenv->load();

//container
$container = require_once 'bootstrap/container.php';

//Aignamos a slim contanedor
AppFactory::setContainer($container);

//Iniciar la conexion con la DB
Connection::init();


$app = AppFactory::create();



(require_once 'public/index.php') ($app);


(require_once 'routes/campers.php') ($app);
(require_once 'routes/users.php') ($app);

$app->run();