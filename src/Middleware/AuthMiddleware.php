<?php

namespace App\Middleware;

use App\Domain\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as SlimResponse;

class AuthMiddleware
{
    // $repo = new AuthMiddleware() <= ()

    public function __construct()
    {
        
    }

    public function __invoke(Request $request, Handler $handler): Response
    {
        $auth = $request->getHeaderLine('Authorization'); // Basic YW...K0Tkw

        if (!$auth || !str_starts_with($auth, 'Basic ')) {
            return $this->unauthorized();
        }

        $decoded = base64_decode(substr($auth, 6));
        [$email, $password] = explode(':', $decoded); // ej: adrian@gmail.com:12345

        // Cambiar al repositorio encargado...
        $user = User::where('email', $email)->first();

        // Validamos contraseña
        if (!$user || !password_verify($password, $user->password)) {
            return $this->unauthorized();
        }

        $request = $request->withAttribute('user', $user);
        return $handler->handle($request);
    }

    private function unauthorized(): Response
    {
        $response = new SlimResponse();
        $response->getBody()->write(json_encode(['error' => 'Unauthorized']));
        return $response->withStatus(401)
                        ->withHeader('Content-Type', 'application/json');
    }
}