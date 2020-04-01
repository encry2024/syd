<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Repository\Commission\Operation;

use Syd\CommissionTask\Model\User\User;
use Syd\CommissionTask\Repository\Commission\Calculator;
use Syd\CommissionTask\Repository\Memory\MemoryRepository;
use Syd\CommissionTask\Service\CurrencyConverter;

class CashOut extends Calculator
{
    const COMMISSION_PERCENT = 0.3;
    const COMMISSION_MIN_LEGAL = 0.50;

    private $repository;

    public function __construct(User $user, MemoryRepository $userRepository)
    {
        parent::__construct($user);
        $this->repository = $userRepository;
    }

    public function calculate(): float
    {
        $person_type = $this->user->getUserType();

        if ($person_type === 'natural') {
            $commission = $this->calculateForNaturalPerson();
        } elseif ($person_type === 'legal') {
            $commission = $this->calculateForLegalPerson();
        }

        return (float) $commission;
    }

    protected function calculateForNaturalPerson(): float
    {
        $current_amount = CurrencyConverter::convertToEur($this->user->getAmount(), $this->user->getCurrency());

        $commission = $current_amount * self::COMMISSION_PERCENT / 100;

        $converted = CurrencyConverter::convertEur($commission, $this->user->getCurrency());

        return $converted;
    }

    protected function calculateForLegalPerson(): float
    {
        $commission = $this->user->getAmount() * self::COMMISSION_PERCENT / 100;

        if ($commission < self::COMMISSION_MIN_LEGAL) {
            return self::COMMISSION_MIN_LEGAL;
        }

        return $commission;
    }
}
