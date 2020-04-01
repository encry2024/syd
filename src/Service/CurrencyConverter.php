<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Service;

class CurrencyConverter
{
    const EUR_CONVERSION = [
        'EUR' => 1,
        'USD' => 1.1497,
        'JPY' => 129.53,
    ];

    public static function convertEUR($amount, $currency): float
    {
        $total = $amount * self::EUR_CONVERSION[$currency];

        return (float) $total;
    }

    public static function convertToEUR($amount, $currency): float
    {
        $total = $amount / self::EUR_CONVERSION[$currency];

        return (float) $total;
    }
}
