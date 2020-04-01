<?php

declare(strict_types=1);

namespace Syd\CommissionTask\Service;

use Syd\CommissionTask\Interfaces\File;

class CSVParser implements File
{
    const FILE_DIRECTORY = '.\\file_storage\\excel\\csv\\';

    public function parseFile($csv): array
    {
        if (!$this->fileExists($csv)) {
            return 'File does not exists.';
        }

        $parsedValues = [];
        $rowCount = 1;

        if (($file = fopen(self::FILE_DIRECTORY.$csv, 'r')) !== false) {
            while (($data = fgetcsv($file, 1000, ',')) !== false) {
                $rowIndex = count($data);
                $rowCount++;

                for ($currentIndex = 0; $currentIndex < $rowIndex; $currentIndex++) {
                    $parsedValues[] = explode(',', $data[$currentIndex]);
                }
            }

            fclose($file);
        }

        return $parsedValues;
    }

    protected function fileExists($csv): bool
    {
        if (!file_exists(self::FILE_DIRECTORY.$csv)) {
            return false;
        }

        return true;
    }
}
