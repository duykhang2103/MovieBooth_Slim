<?php

namespace App\Application\Actions\Ticket;

use App\Domain\Movie\MovieNotFoundException;
use App\Domain\User\UserNotFoundException;
use Exception;
use Psr\Http\Message\ResponseInterface;

class CreateTicketAction extends TicketAction
{
  public function action(): ResponseInterface
  {
    $data = $this->request->getParsedBody();
    $userId = $data["userId"];
    $movieId = $data["movieId"];
    try {
      $ticket = $this->ticketService->create($userId, $movieId);
      $this->logger->info("Ticket was created", ["ticket_id" => $ticket->id]);
      return $this->respondWithData(
        [
          "message" => "Ticket was created",
          "data" => $ticket
        ]
      );
    } catch (UserNotFoundException | MovieNotFoundException $e) {
      $this->logger->error($e->getErrorMessage());
      return $this->respondWithData(
        [
          "message" => $e->getErrorMessage(),
        ],
        $e->getStatusCode()
      );
    }
  }
}
