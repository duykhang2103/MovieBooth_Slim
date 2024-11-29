<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface;

class ListCategoriesAction extends CategoryAction
{
    protected function action(): ResponseInterface
    {
        $tickets = $this->categoryService->findAll();

        $this->logger->info("Categories list was viewed");

        return $this->respondWithData([
            "message" => "Categories list was viewed",
            "data" => $tickets
        ]);
    }
}
