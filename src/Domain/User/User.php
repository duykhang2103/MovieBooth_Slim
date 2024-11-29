<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Ticket\Ticket;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: "users")]
class User
{
    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    public int $id;

    #[Column(type: 'string', unique: true, nullable: false)]
    public string $email;

    #[OneToMany(mappedBy: 'user', targetEntity: Ticket::class)]
    private Collection $tickets;


    public function __construct(string $email)
    {
        $this->email = $email;
        $this->tickets = new ArrayCollection();

        // $this->registeredAt = new DateTimeImmutable('now');
    }

    public function getTickets(): Collection
    {
        return $this->tickets;
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
