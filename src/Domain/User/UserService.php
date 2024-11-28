<?php
namespace App\Domain\User;

use Doctrine\ORM\EntityManager;
use UserAlreadyExistsException;

class UserService  {
  public function __construct(private EntityManager $em) {}
  public function create(string $email) {
    $createdUser = $this->findUserByEmail($email);
    if ($createdUser !== null) {
      throw new UserAlreadyExistsException($email);
    }
    $user = new User($email);
    $this->em->persist($user);
    $this->em->flush();

    return $user;
  }
  
  public function findAll(): array {
    return $this->em->getRepository(User::class)->findAll();
  }

  public function findUserById(int $id): User {
    $user = $this->em->getRepository(User::class)->find($id);
    if ($user === null) {
      throw new UserNotFoundException(userId: $id);
    }
    return $user;
  }

  public function findUserByEmail(string $email): User {
    $user = $this->em->getRepository(User::class)->find($email);
    if ($user === null) {
      throw new UserNotFoundException(email: $email);
    }
    return $user;
  }

  public function updateUser(User $user) {
    $this->em->persist($user);
    $this->em->flush();
    return $user;
  }

  public function deleteUser(User $user) {
    $this->em->remove($user);
    $this->em->flush();
  }

  public function deleteUserById(int $id) {
    $user = $this->findUserById($id);
    $this->deleteUser($user);
  }

  public function deleteUserByEmail(string $email) {
    $user = $this->findUserByEmail($email);
    $this->deleteUser($user);
  }
}