<?php

namespace App\Domain\User;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Exception;

class UserService
{
  public function __construct(private EntityManager $em) {}
  public function create(string $email)
  {
    $existingUser = $this->findUserByEmail($email);
    if ($existingUser !== null) {
      throw new UserAlreadyExistsException($email);
    }
    $user = new User($email);
    $this->em->persist($user);
    $this->em->flush();

    return $user;
  }

  public function findAll(): array
  {
    return $this->em->getRepository(User::class)->findAll();
  }

  public function findUserById(int $id): User | null
  {
    $user = $this->em->getRepository(User::class)->findOneBy(["id" => $id]);
    return $user;
  }

  public function findUserBuyMostTickets(): ?User
  {
    $sql = "
      SELECT u.*
      FROM users u
      JOIN (
          SELECT t.user_id, COUNT(*) as num_tickets
          FROM tickets t
          GROUP BY t.user_id
      ) user_ticket ON u.id = user_ticket.user_id
      ORDER BY user_ticket.num_tickets DESC
      LIMIT 1
  ";

    $rsm = new ResultSetMapping();
    $rsm->addEntityResult(User::class, 'u');
    $rsm->addFieldResult('u', 'id', 'id');
    $rsm->addFieldResult('u', 'email', 'email');

    $query = $this->em->createNativeQuery($sql, $rsm);
    $result = $query->getOneOrNullResult() ?? null;

    return $result;
  }

  public function findUserByEmail(string $email): User | null
  {
    $user = $this->em->getRepository(User::class)->findOneBy(["email" => $email]);
    return $user;
  }

  public function updateUser(User $user)
  {
    $this->em->persist($user);
    $this->em->flush();
    return $user;
  }

  public function deleteUser(User $user)
  {
    $this->em->remove($user);
    $this->em->flush();
  }

  public function deleteUserById(int $id)
  {
    $user = $this->findUserById($id);
    $this->deleteUser($user);
  }

  public function deleteUserByEmail(string $email)
  {
    $user = $this->findUserByEmail($email);
    $this->deleteUser($user);
  }
}
