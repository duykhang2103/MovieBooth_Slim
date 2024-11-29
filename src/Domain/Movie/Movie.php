<?php

namespace App\Domain\Movie;

use App\Domain\Category\Category;
use App\Domain\Ticket\Ticket;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table("movies")]
class Movie
{
  #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
  public int $id;

  #[Column(type: 'string', nullable: false)]
  public string $title;

  #[Column(type: 'string', nullable: true)]
  public string $description;

  #[ManyToOne(targetEntity: Category::class, inversedBy: 'movies')]
  #[JoinColumn(name: 'category_id', referencedColumnName: 'id')]
  public Category $category;

  #[Column(type: 'string', nullable: true)]
  public string $url;

  #[Column(type: 'string', nullable: true)]
  public string $image;

  #[OneToMany(mappedBy: 'movie', targetEntity: Ticket::class)]
  private Collection $tickets;

  public function __construct()
  {
    $this->tickets = new ArrayCollection();
  }

  public function getTickets(): Collection
  {
    return $this->tickets;
  }
}
