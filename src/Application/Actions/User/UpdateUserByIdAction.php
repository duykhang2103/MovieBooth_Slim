<?php

namespace App\Application\Actions\User;

use App\Application\Actions\ActionPayload;
use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface;

class UpdateUserByIdAction extends UserAction
{
  public function action(): ResponseInterface
  {
    try {
      $id = $this->resolveArg("id");
      $user = $this->userService->updateUser($id);
      return $this->respondWithData([
        "message" => "User was updated",
        "data" => $user
      ]);
    } catch (UserNotFoundException $e) {
      return $this->respondWithData([
        "message" => $e->getErrorMessage()
      ], $e->getStatusCode());
    }
  }
}
