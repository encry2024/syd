<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Repository\Commission;

use Exception;
use Syd\CommissionTask\Model\User\User;
use Syd\CommissionTask\Repository\Commission\Operation\CashIn;
use Syd\CommissionTask\Repository\Commission\Operation\CashOut;
use Syd\CommissionTask\Repository\Memory\MemoryRepository;

class Commission extends Calculator
{
    protected $memoryRepository;

    public function __construct(MemoryRepository $memoryRepository)
    {
        $this->memoryRepository = $memoryRepository;
    }

    public function calculate(): array
    {
        $results = [];

        foreach ($this->memoryRepository->getAll() as $user) {
            $calculator = $this->getOperation($user);

            $results[] = $this->format($calculator->calculate());
        }

        return $results;
    }

    protected function getOperation(User $user)
    {
        $operation_name = $user->getOperationType();

        switch ($user->getOperationType()) {
            case User::CASH_IN:
                $operation = new CashIn($user);
                break;
            case User::CASH_OUT:
                $operation = new CashOut($user, $this->memoryRepository);
                break;
            default:
                throw new Exception('Unknown operation: '.$operation_name);
                break;
        }

        return $operation;
    }

    protected function format($result): string
    {
        $rounded = ceil($result * 100) / 100;

        $formatted_result = number_format((float) $rounded, 2, '.', '');

        return $formatted_result;
    }
}
