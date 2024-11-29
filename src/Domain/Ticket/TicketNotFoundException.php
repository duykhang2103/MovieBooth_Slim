<?php

declare(strict_types=1);

namespace App\Domain\Ticket;

use App\Domain\Exception\DomainRecordNotFoundException;

class TicketNotFoundException extends DomainRecordNotFoundException
{
    public function __construct(string $id)
    {
        parent::__construct();
        $this->message = "Ticket with id: $id not found.";
    }

    public function getStatusCode(): int
    {
        return 404;
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }
}
