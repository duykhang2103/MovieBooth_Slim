<?php

namespace App\Application\Actions\User;

use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface;

class DeleteUserByEmailAction extends UserAction {
  public function action(): ResponseInterface {
    $email = $this->resolveArg("email");
    try {
      $this->userService->deleteUserByEmail($email);
      return $this->respondWithData([
        "message" => "User with $email was deleted"
      ]);
    } catch (UserNotFoundException $e) {
      return $this->respondWithData([
        "message"=> $e->getErrorMessage()], $e->getStatusCode());
      }
    }
}