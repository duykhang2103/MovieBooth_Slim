<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class ViewUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        try {
            $user = $this->userService->findUserById($userId);
            
            $this->logger->info("User of id `{$userId}` was viewed.");
            
            return $this->respondWithData($user);
        } catch (UserNotFoundException $e) {
            $this->logger->error("User of id $userId was not found.");
            return $this->respondWithData([
                "message" => $e->getErrorMessage()
            ], $e->getStatusCode());
        }
    }
}
