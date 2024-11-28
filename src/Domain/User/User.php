<?php

declare(strict_types=1);

namespace App\Domain\User;

use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name:"users")]
class User {
    // private ?int $id;

    // private string $username;

    // private string $firstName;

    // private string $lastName;

    // public function __construct(?int $id, string $username, string $firstName, string $lastName)
    // {
    //     $this->id = $id;
    //     $this->username = strtolower($username);
    //     $this->firstName = ucfirst($firstName);
    //     $this->lastName = ucfirst($lastName);
    // }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // public function getUsername(): string
    // {
    //     return $this->username;
    // }

    // public function getFirstName(): string
    // {
    //     return $this->firstName;
    // }

    // public function getLastName(): string
    // {
    //     return $this->lastName;
    // }

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    public int $id;

    #[Column(type: 'string', unique: true, nullable: false)]
    public string $email;

    // #[Column(name: 'registered_at', type: 'datetimetz_immutable', nullable: false)]
    // private DateTimeImmutable $registeredAt;

    public function __construct(string $email)
    {
        $this->email = $email;
        // $this->registeredAt = new DateTimeImmutable('now');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    // public function getRegisteredAt(): DateTimeImmutable
    // {
    //     return $this->registeredAt;
    // }

    // #[\ReturnTypeWillChange]
    // public function jsonSerialize(): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'username' => $this->username,
    //         'firstName' => $this->firstName,
    //         'lastName' => $this->lastName,
    //     ];
    // }
}
