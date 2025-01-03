<?php

namespace App\Domain\User;

use App\Domain\Exception\DomainAlreadyExistsException;

class UserAlreadyExistsException extends DomainAlreadyExistsException
{
    public function __construct($email)
    {
        parent::__construct();
        $this->message = "User with email $email already exists.";
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
