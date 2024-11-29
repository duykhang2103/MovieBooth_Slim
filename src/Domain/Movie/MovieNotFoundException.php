<?php

declare(strict_types=1);

namespace App\Domain\Movie;

use App\Domain\Exception\DomainRecordNotFoundException;

class MovieNotFoundException extends DomainRecordNotFoundException
{
    public function __construct(int $movieId)
    {
        parent::__construct();
        $this->message = "Movie with id: $movieId not found.";
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
