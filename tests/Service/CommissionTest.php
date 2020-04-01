<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Syd\CommissionTask\Model\User\User;
use Syd\CommissionTask\Repository\Commission\Commission;
use Syd\CommissionTask\Repository\Memory\MemoryRepository;
use Syd\CommissionTask\Service\Math;

class CommissionTest extends TestCase
{
    public function testCompute()
    {
        $memoryRepository = new MemoryRepository();
        $users = $this->dataProviderForComputeTesting();
        $memoryId = 1;

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->setId($memoryId++);
            $newUser->setDate($user[0]);
            $newUser->setUserId((int) $user[1]);
            $newUser->setUserType($user[2]);
            $newUser->setOperationType($user[3]);
            $newUser->setAmount($user[4]);
            $newUser->setCurrency($user[5]);

            $memoryRepository->add($newUser);
        }

        $calculator = new Commission($memoryRepository);


        $this->assertNotEmpty($calculator->calculate());
    }

    public function dataProviderForComputeTesting(): array
    {
        $users = [
            ['2014-12-31', '4', 'natural', 'cash_out', '1200.00', 'EUR'],
            ['2015-01-01','4','natural','cash_out','1000.00','EUR'],
            ['2016-01-05','4','natural','cash_out','1000.00','EUR'],
            ['2016-01-05','1','natural','cash_in','200.00','EUR'],
            ['2016-01-06','2','legal','cash_out','300.00','EUR'],
            ['2016-01-07','1','natural','cash_out','1000.00','EUR'],
            ['2016-01-10','1','natural','cash_out','100.00','EUR'],
            ['2016-01-10','2','legal','cash_in','1000000.00','EUR'],
            ['2016-01-10','3','natural','cash_out','1000.00','EUR'],
            ['2016-02-15','1','natural','cash_out','300.00','EUR'],
            ['2016-01-07','1','natural','cash_out','100.00','USD'],
            ['2016-02-19','2','natural','cash_out','3000000','JPY']
        ];

        return $users;
    }
}
