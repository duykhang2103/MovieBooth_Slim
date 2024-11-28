<?php

namespace App\Application\Actions\User;

use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface;

class DeleteUserByIdAction extends UserAction {
  public function action(): ResponseInterface {
    
    $id = $this->resolveArg("id");
    try {
      $this->userService->deleteUserById($id);
      return $this->respondWithData([
        "message" => "User with $id was deleted"
      ]);

    } catch (UserNotFoundException $e) {
      return $this->respondWithData([
        "message"=> $e->getErrorMessage()], $e->getStatusCode());
    }
  }    
}