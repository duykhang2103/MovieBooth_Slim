<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Exception\DomainRecordNotFoundException;

class UserNotFoundException extends DomainRecordNotFoundException
{
    public function __construct(?string $userId = null, ?string $email = "")
    {
        parent::__construct();
        if($userId === null) {
            $this->message = "User with email: $email not found.";
        } else {
            $this->message = "User with id: $userId not found.";
        }
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
