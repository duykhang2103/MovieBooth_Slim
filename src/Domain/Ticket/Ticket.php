<?php

namespace App\Domain\Ticket;

use App\Domain\Movie\Movie;
use App\Domain\User\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table("tickets")]
class Ticket
{
  #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
  public int $id;

  #[ManyToOne(targetEntity: User::class, inversedBy: 'users')]
  #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
  public User $users;

  #[ManyToOne(targetEntity: Movie::class, inversedBy: 'movies')]
  #[JoinColumn(name: 'movie_id', referencedColumnName: 'id')]
  public Movie $movies;
}
