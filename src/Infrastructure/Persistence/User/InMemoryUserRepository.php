<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;

class InMemoryUserRepository implements IUserService
{
    /**
     * @var User[]
     */
    private array $users;

    /**
     * @param User[]|null $users
     */
    public function __construct(?array $users = null)
    {
        $this->users = $users ?? [
            // 1 => new User(1, 'bill.gates', 'Bill', 'Gates'),
            // 2 => new User(2, 'steve.jobs', 'Steve', 'Jobs'),
            // 3 => new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            // 4 => new User(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            // 5 => new User(5, 'jack.dorsey', 'Jack', 'Dorsey'),
            1 => new User("bill.gates",),
            2 => new User( 'steve.jobs'),
            3 => new User( 'mark.zuckerberg'),
            4 => new User( 'evan.spiegel'),
            5 => new User( 'jack.dorsey'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {   
        // return array_values($this->users);
        return array_values(["bill.gates","steve.jobs","mark.zuckerberg","evan.spiegel","jack.dorsey"]);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }
}
