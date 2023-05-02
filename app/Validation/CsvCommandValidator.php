<?php

namespace App\Validation;

class CsvCommandValidator
{
    public function validate(array $arguments): bool
    {
        return $this->isCsvFilePathValid($arguments['path']) && $this->isUrlValid($arguments['url']);
    }

    private function isUrlValid(string $url): bool
    {
        return (bool) preg_match(
            '/\b((https?|ftp|file):\/\/|www\.)[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i',
            $url
        );
    }

    private function isCsvFilePathValid(string $path): bool
    {
        return (bool) preg_match(
            '/.csv$/i',
            $path
        );
    }
}
