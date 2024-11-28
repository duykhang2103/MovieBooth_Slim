<?php

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table("movies")]
class Movie {
  #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
  public int $id;

  #[Column(type:'string', nullable: false)]
  public string $title;

  #[Column(type:'string', nullable: true)]
  public string $description;

  #[Column(type:'string', nullable: true)]
  public string $url;

  #[Column(type:'string', nullable: true)]
  public string $image;
}