<?php

namespace App\Application\Actions\Movie;

use App\Application\Actions\Action;
use App\Domain\Movie\MovieService;
use Psr\Log\LoggerInterface;

abstract class MovieAction extends Action
{
  protected MovieService $movieService;

  public function __construct(LoggerInterface $logger, MovieService $movieService)
  {
    parent::__construct($logger);
    $this->movieService = $movieService;
  }
}
