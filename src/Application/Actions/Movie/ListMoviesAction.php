<?php

declare(strict_types=1);

namespace App\Application\Actions\Movie;

use Psr\Http\Message\ResponseInterface;

class ListMoviesAction extends MovieAction
{
    protected function action(): ResponseInterface
    {
        // try {

        $movies = $this->movieService->findAll();

        $this->logger->info("Movies list was viewed");

        return $this->respondWithData([
            "message" => "Movies list was viewed",
            "data" => $movies
        ]);
        // } catch (\Exception $e) {
        //     $this->logger->error("An error occurred: " . $e->getErrorMessage());
        //     throw new \Slim\Exception\HttpInternalServerErrorException($this->request, $e->getErrorMessage());
        // }
    }
}
