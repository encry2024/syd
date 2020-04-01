<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Repository\User;

use Syd\CommissionTask\Interfaces\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    protected $users;

    public function getAll(): array
    {
        return $this->users;
    }
}
