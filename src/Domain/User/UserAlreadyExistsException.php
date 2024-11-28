<?php

use App\Domain\Exception\DomainAlreadyExistsException;

class UserAlreadyExistsException extends DomainAlreadyExistsException
{
    public function __construct($email)
    {
        parent::__construct();
        $this->message = "User with id $email already exists.";
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