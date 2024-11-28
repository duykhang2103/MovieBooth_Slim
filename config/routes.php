<?php

declare(strict_types=1);

use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\DeleteUserByEmailAction;
use App\Application\Actions\User\DeleteUserByIdAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\User\UpdateUserByIdAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    
    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('/{email}', CreateUserAction::class);
        $group->put('/{id}', UpdateUserByIdAction::class);
        $group->delete('/{id:\d+}', DeleteUserByIdAction::class); // Only allow numbers for the ID
        $group->delete('/{email}', DeleteUserByEmailAction::class);
    });

    // Catch-all route to serve a 404 Not Found page if none of the routes match
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
        $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
        return $handler($req, $res);
    });
};
