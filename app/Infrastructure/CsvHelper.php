<?php

namespace App\Infrastructure;

use App\Domain\CsvHelperInterface;

class CsvHelper implements CsvHelperInterface
{
    public function export(string $fileName, array $headers, array $data): void
    {
        $file = fopen($fileName, 'w');
        fputcsv($file, $headers);

        /** @var array $item */
        foreach ($data as $item) {
            fputcsv($file, $item);
        }

        fclose($file);
    }

    public function append(string $fileName, array $data): void
    {
        $file = fopen($fileName, 'a');

        /** @var array $item */
        foreach ($data as $item) {
            fputcsv($file, $item);
        }

        fclose($file);
    }
}
