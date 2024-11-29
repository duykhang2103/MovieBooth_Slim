<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Respect\Validation\Validator;
use App\Domain\User\UserAlreadyExistsException;
use Exception;
use Psr\Http\Message\ResponseInterface;

class CreateUserAction extends UserAction
{
  // private static $validator;

  // public function __construct()
  // {
  //   self::$validator = new Validator();
  //   $this->applyValidationRules();
  // }

  // public static function applyValidationRules()
  // {
  //   self::$validator->attribute('email', self::$validator->string()->notEmpty());
  // }

  // public static function v($subject)
  // {
  //   self::$validator->assert($subject);
  // }

  // public function validate()
  // {
  //   self::v($this);
  // }

  protected function action(): ResponseInterface
  {
    $email = $this->request->getParsedBody()["email"];
    try {
      $user = $this->userService->create($email);
      $this->logger->info("User was created ", ["user" => $user]);
      return $this->respondWithData(
        [
          "message" => "User was created",
          "data" => $user
        ]
      );
    } catch (UserAlreadyExistsException $e) {
      $this->logger->info($e->getErrorMessage());
      return $this->respondWithData([
        "message" => $e->getErrorMessage()
      ], $e->getStatusCode());
    }
    // catch (Exception $e) {
    //   $this->logger->error("fail to catch");
    //   return $this->respondWithData([
    //     "message"=> $e->getMessage()
    //     ], 500);
    //   }

  }
}
