<?php

namespace App\Application\Actions\Movie;

use App\Domain\Category\CategoryNotFoundException;
use Exception;
use Psr\Http\Message\ResponseInterface;

class CreateMovieAction extends MovieAction
{
  public function action(): ResponseInterface
  {
    $data = $this->request->getParsedBody();
    $title = $data["title"];
    $categoryName = $data["categoryName"];
    try {
      $movie = $this->movieService->create(title: $title, categoryName: $categoryName);
      $this->logger->info("Movie was created", ["movie" => $movie->title]);
      return $this->respondWithData(
        [
          "message" => "Movie was created",
          "data" => $movie
        ]
      );
    } catch (CategoryNotFoundException $e) {
      $this->logger->info($e->getErrorMessage());
      return $this->respondWithData([
        "message" => $e->getErrorMessage()
      ], $e->getStatusCode());
    }
  }
}
