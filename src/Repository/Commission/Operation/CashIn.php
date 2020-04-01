<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Repository\Commission\Operation;

use Syd\CommissionTask\Model\User\User;

class CashIn
{
    const COMMISSION_PERCENT = 0.03;
    const COMMISSION_MAX = 5;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function calculate(): float
    {
        $userCommission = $this->user->getAmount() * self::COMMISSION_PERCENT / 100;

        if ($userCommission > self::COMMISSION_MAX) {
            return self::COMMISSION_MAX;
        }

        return $userCommission;
    }
}
