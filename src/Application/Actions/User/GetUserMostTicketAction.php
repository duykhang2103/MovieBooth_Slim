<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\UserNotFoundException;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class GetUserMostTicketAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $user = $this->userService->findUserBuyMostTickets();
        if ($user === null) {
            return $this->respondWithData([
                "message" => "No user."
            ], 404);
        }
        $this->logger->info("User of id `{$user->id}` was viewed.");

        return $this->respondWithData($user);
    }
}
