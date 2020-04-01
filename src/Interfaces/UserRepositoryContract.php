<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Interfaces;

interface UserRepositoryContract
{
    public function getAll(): array;
}
