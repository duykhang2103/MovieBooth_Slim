<?php

declare(strict_types=1);
namespace App\Application\Actions\User;

use Exception;
use Psr\Http\Message\ResponseInterface;
use UserAlreadyExistsException;

class CreateUserAction extends UserAction {

  public function validate (string $username, string $email) {}

  protected function action(): ResponseInterface {
    $email = $this->resolveArg(
      "email",
    );
    try {
      $user = $this->userService->create($email);
  
      $this->logger->info("User was created ", ["user" => $user]);
      return $this->respondWithData(
        [
          "message" => "User was created",
          "data" => $user
        ]
      );

    }
    catch (UserAlreadyExistsException $e) {
      $this->logger->info($e->getErrorMessage());
      return $this->respondWithData([
        "message"=> $e->getErrorMessage()
      ], $e->getStatusCode());
    }
    catch (Exception $e) {
      $this->logger->error("check catch error");
      return $this->respondWithData([
        "message"=> $e->getMessage()
        ], 500);
      }

  }
}