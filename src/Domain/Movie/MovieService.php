<?php

use Doctrine\ORM\EntityManager;

class MovieService {
  public function __construct(private EntityManager $em) {}

  public function create(string $title, ?string $description, ?string $url, ?string $image) {
    $movie = new Movie();
    $movie->title = $title;
    $movie->description = $description;
    $movie->url = $url;
    $movie->image = $image;
    $this->em->persist($movie);
    $this->em->flush();
    
    return $movie;
  }

}