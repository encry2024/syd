<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Model\User;

class User
{
    const CASH_OUT = 'cash_out';
    const CASH_IN = 'cash_in';
    private $id;
    private $date;
    private $user_id;
    private $user_type;
    private $operation_type;
    private $amount;
    private $currency;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserType(): string
    {
        return $this->user_type;
    }

    public function setUserType(string $user_type)
    {
        $this->user_type = $user_type;
    }

    public function getOperationType(): string
    {
        return $this->operation_type;
    }

    public function setOperationType(string $operation_type)
    {
        $this->operation_type = $operation_type;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount)
    {
        $this->amount = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }
}
