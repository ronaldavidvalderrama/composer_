<?php

namespace App\Handler;

use InvalidArgumentException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

class CustomErrorHandler {

    public function __construct(private ResponseFactoryInterface $response) {}

    public function __invoke(ServerRequestInterface $request, Throwable $exection, bool $dasplayErrorDetail, bool $slogErrors, bool $logErrorDetail, bool $slogErrorDetail): ResponseInterface
    {
        $status = 500;
        $message = "Error interno en e servidor.";

        if ($exection instanceof HttpNotFoundException) {
            $status = 404;
            $message = "Ruta no encontrada";
        }elseif ($exection instanceof InvalidArgumentException) {
            $status = 422;
            $message = $exection->getMessage();
        }



        $response = $this->response->createResponse($status);
        $response->getBody()->write(json_encode(['error' => $message]));
        return $response->withHeader('contentt_Type', 'application/json');
    }
}