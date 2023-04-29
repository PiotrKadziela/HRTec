<?php

namespace App\Domain;

interface CsvHelperInterface
{
    public function export(string $fileName, array $headers, array $data): void;
    public function append(string $fileName, array $data): void;
}
