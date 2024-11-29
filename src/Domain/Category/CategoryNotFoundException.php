<?php

declare(strict_types=1);

namespace App\Domain\Category;

use App\Domain\Exception\DomainRecordNotFoundException;

class CategoryNotFoundException extends DomainRecordNotFoundException
{
    public function __construct(string $name)
    {
        parent::__construct();
        $this->message = "Category with name: $name not found.";
    }

    public function getStatusCode(): int
    {
        return 404;
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }
}
