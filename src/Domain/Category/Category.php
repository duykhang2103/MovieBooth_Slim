<?php

namespace App\Domain\Category;

use App\Domain\Movie\Movie;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table("categories")]
class Category
{
  #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
  public int $id;

  #[Column(type: 'string')]
  public string $name;

  #[OneToMany(targetEntity: Movie::class, mappedBy: 'category')]
  public Collection $movies;
}
