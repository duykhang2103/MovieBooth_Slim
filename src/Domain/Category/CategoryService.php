<?php

namespace App\Domain\Category;

use Doctrine\ORM\EntityManager;

class CategoryService
{
  public function __construct(private EntityManager $em) {}

  public function create($name): Category
  {
    $existingCategory = $this->findByName($name);
    if ($existingCategory !== null) {
      throw new CategoryAlreadyExistsException($name);
    }
    $category = new Category();
    $category->name = $name;
    $this->em->persist($category);
    $this->em->flush();
    return $category;
  }

  public function findById($id): Category | null
  {
    return $this->em->getRepository(Category::class)->findOneBy(["id" => $id]);
  }

  public function findByName($name): Category | null
  {
    return $this->em->getRepository(Category::class)->findOneBy(["name" => $name]);
  }

  public function findAll(): array
  {
    return $this->em->getRepository(Category::class)->findAll();
  }
}
