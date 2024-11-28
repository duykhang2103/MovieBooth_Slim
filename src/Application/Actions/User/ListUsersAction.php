<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface;

class ListUsersAction extends UserAction
{
    protected function action(): ResponseInterface
    {
        // try {

            $users = $this->userService->findAll();
            
            $this->logger->info("Users list was viewed");
            
            return $this->respondWithData([
                "message" => "Users list was viewed",
                "data" => $users
            ]);
        // } catch (\Exception $e) {
        //     $this->logger->error("An error occurred: " . $e->getErrorMessage());
        //     throw new \Slim\Exception\HttpInternalServerErrorException($this->request, $e->getErrorMessage());
        // }
    }
}
