<?php

declare(strict_types=1);

namespace App\Application\Actions\Ticket;

use Psr\Http\Message\ResponseInterface;

class ListTicketsAction extends TicketAction
{
    protected function action(): ResponseInterface
    {
        $tickets = $this->ticketService->findAll();

        $this->logger->info("Tickets list was viewed");

        return $this->respondWithData([
            "message" => "Tickets list was viewed",
            "data" => $tickets
        ]);
    }
}
