<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Repository\Memory;

use Syd\CommissionTask\Interfaces\MemoryRepositoryContract;
use Syd\CommissionTask\Model\User\User;

class MemoryRepository implements MemoryRepositoryContract
{
    protected $users;

    public function add(User $user)
    {
        $this->users[] = $user;
    }

    public function getAll(): array
    {
        return $this->users;
    }
}
