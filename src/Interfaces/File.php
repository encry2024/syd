<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Interfaces;

interface File
{
    public function parseFile($file): array;
}
