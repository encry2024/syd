<?php

require 'vendor/autoload.php';

use Syd\CommissionTask\Service\CSVParser;
use Syd\CommissionTask\Model\User\User;
use Syd\CommissionTask\Repository\Memory\MemoryRepository;
use Syd\CommissionTask\Repository\Commission\Commission;

if (isset($argc)) {
	if (count($argv) === 1) {
		$msg = 'File is not valid for process';

		echo $msg;

		exit();
	}

	$memoryRepository = new MemoryRepository();
	$csv = new CSVParser();
	$parsedValues = $csv->parseFile($argv[1]);
	$memoryId = 1;

	foreach ($parsedValues as $value) {
		$user = new User();
		$user->setId($memoryId++);
		$user->setDate($value[0]);
		$user->setUserId((int) $value[1]);
		$user->setUserType($value[2]);
		$user->setOperationType($value[3]);
		$user->setAmount($value[4]);
		$user->setCurrency($value[5]);

		$memoryRepository->add($user);
	}

	$calculator = new Commission($memoryRepository);
	$results = $calculator->calculate();

	foreach ($results as $result) {
		fwrite(STDOUT, $result);
		fwrite(STDOUT, "\n");
	}
} else {
	echo "argc and argv disabled\n";
}