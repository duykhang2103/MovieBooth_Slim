<?php

declare(strict_types=1);

use App\Application\Actions\Category\CreateCategoryAction;
use App\Application\Actions\Category\ListCategoriesAction;
use App\Application\Actions\Movie\CreateMovieAction;
use App\Application\Actions\Movie\ListMoviesAction;
use App\Application\Actions\Ticket\CreateTicketAction;
use App\Application\Actions\Ticket\ListTicketsAction;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\DeleteUserByEmailAction;
use App\Application\Actions\User\DeleteUserByIdAction;
use App\Application\Actions\User\GetUserMostTicketAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\User\UpdateUserByIdAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Validations\User\CreateUserValidation;
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
        $group->get('/', ListUsersAction::class);
        $group->get('/most', GetUserMostTicketAction::class);
        $group->get('/{id:\d+}', ViewUserAction::class);
        $group->post('/', CreateUserAction::class)
            // ->add(CreateUserValidation::class)
        ;
        $group->put('/{id}', UpdateUserByIdAction::class);
        $group->delete('/{id:\d+}', DeleteUserByIdAction::class); // Only allow numbers for the ID
        $group->delete('/{email}', DeleteUserByEmailAction::class);
    });

    $app->group('/categories', function (Group $group) {
        $group->get('/', ListCategoriesAction::class);
        $group->post('/', CreateCategoryAction::class);
    });

    $app->group('/movies', function (Group $group) {
        $group->get('/', ListMoviesAction::class);
        $group->post('/', CreateMovieAction::class);
    });

    $app->group('/tickets', function (Group $group) {
        $group->get(
            '/',
            ListTicketsAction::class
        );
        $group->post('/', CreateTicketAction::class);
    });

    // Catch-all route to serve a 404 Not Found page if none of the routes match
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($req, $res) {
        $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
        return $handler($req, $res);
    });
};
