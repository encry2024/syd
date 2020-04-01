<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Interfaces;

interface MemoryRepositoryContract
{
    public function getAll(): array;
}
