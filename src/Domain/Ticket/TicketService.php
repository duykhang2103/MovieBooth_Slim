<?php

namespace App\Domain\Ticket;

use App\Domain\Movie\Movie;
use App\Domain\Movie\MovieNotFoundException;
use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use Doctrine\ORM\EntityManager;

class TicketService
{
  public function __construct(private EntityManager $em) {}

  public function create(int $user_id, int $movie_id): Ticket
  {
    $existingUser = $this->em->getRepository(User::class)->findOneBy(["id" => $user_id]);
    if ($existingUser === null) {
      throw new UserNotFoundException($user_id);
    }
    $existingMovie = $this->em->getRepository(Movie::class)->findOneBy(["id" => $movie_id]);
    if ($existingMovie === null) {
      throw new MovieNotFoundException($movie_id);
    }
    $ticket = new Ticket();
    $ticket->users = $existingUser;
    $ticket->movies = $existingMovie;
    $this->em->persist($ticket);
    $this->em->flush();
    return $ticket;
  }

  public function findAll(): array
  {
    return $this->em->getRepository(Ticket::class)->findAll();
  }
}
