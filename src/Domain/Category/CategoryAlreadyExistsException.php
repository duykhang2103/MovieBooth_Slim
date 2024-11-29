<?php

namespace App\Domain\Category;

use App\Domain\Exception\DomainAlreadyExistsException;

class CategoryAlreadyExistsException extends DomainAlreadyExistsException
{
    public function __construct($name)
    {
        parent::__construct();
        $this->message = "Category with name $name already exists.";
    }

    public function getStatusCode(): int
    {
        return 400;
    }
    public function getErrorMessage(): string
    {
        return $this->message;
    }
}
