<?php

namespace App\Application\Actions\Ticket;

use App\Application\Actions\Action;
use App\Domain\Ticket\TicketService;
use Psr\Log\LoggerInterface;

abstract class TicketAction extends Action
{
  protected TicketService $ticketService;

  public function __construct(LoggerInterface $logger, TicketService $ticketService)
  {
    parent::__construct($logger);
    $this->ticketService = $ticketService;
  }
}
