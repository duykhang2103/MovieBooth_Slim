<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Domain\Category\CategoryService;
use Psr\Log\LoggerInterface;

abstract class CategoryAction extends Action
{
    protected CategoryService $categoryService;

    public function __construct(LoggerInterface $logger, CategoryService $categoryService)
    {
        parent::__construct($logger);
        $this->categoryService = $categoryService;
    }
}
