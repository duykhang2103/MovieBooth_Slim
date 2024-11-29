<?php

namespace App\Domain\Movie;

use App\Domain\Category\Category;
use App\Domain\Category\CategoryNotFoundException;
use Doctrine\ORM\EntityManager;

class MovieService
{
  public function __construct(private EntityManager $em) {}

  public function create(string $title, string $categoryName, ?string $description = null, ?string $url = null, ?string $image = null)
  {

    // cant find a way to use CategoryService here
    $existingCategory = $this->em->getRepository(Category::class)->findOneBy(["name" => $categoryName]);
    if ($existingCategory == null) {
      throw new CategoryNotFoundException($categoryName);
    }
    $movie = new Movie();
    $movie->title = $title;
    $movie->description = $description ?? "";
    $movie->url = $url ?? "";
    $movie->image = $image ?? "";
    $movie->category = $existingCategory;
    $this->em->persist($movie);
    $this->em->flush();

    return $movie;
  }

  public function findAll(): array
  {
    return $this->em->getRepository(Movie::class)->findAll();
  }

  public function find(int $id): Movie | null
  {
    return $this->em->getRepository(Movie::class)->find($id);
  }
}
