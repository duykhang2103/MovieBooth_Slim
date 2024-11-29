<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Domain\Category\CategoryAlreadyExistsException;
use Psr\Http\Message\ResponseInterface;

class CreateCategoryAction extends CategoryAction
{
  protected function action(): ResponseInterface
  {
    $name = $this->request->getParsedBody()["name"];
    try {
      $category = $this->categoryService->create($name);
      $this->logger->info("Category was created ", ["category" => $category]);
      return $this->respondWithData(
        [
          "message" => "Category was created",
          "data" => $name
        ]
      );
    } catch (CategoryAlreadyExistsException $e) {
      $this->logger->info($e->getErrorMessage());
      return $this->respondWithData([
        "message" => $e->getErrorMessage()
      ], $e->getStatusCode());
    }
  }
}
