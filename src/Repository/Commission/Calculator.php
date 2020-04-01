<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Repository\Commission;

use Syd\CommissionTask\Model\User\User;

abstract class Calculator
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    abstract public function calculate();
}
