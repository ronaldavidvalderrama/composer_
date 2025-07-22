<?php

namespace App\Middleware;

use psr\Http\Message\ResponseInterface as Response;
use psr\Http\Message\ServerRequestInterface as Request;
use psr\Http\Server\MiddlewareInterface;
use psr\Http\Server\RequestHandlerInterface as Handler;

class JsonBodyParserMiddleware implements MiddlewareInterface 
{
    public function process(Request $request, Handler $handler): Response 
    {

        $contentType = $request->getHeaderLine('Content-Type');
        if (strtr($contentType, ["application/json"])) {
            $data = json_decode(file_get_contents('php://input'), true);
            $request = $request->withParsedBody($data);
        }

        return $handler->handle($request);
    }
}