<?php

namespace App\Domain;

interface DataBuilderInterface
{
    public const CSV_HEADERS = ['title', 'description', 'link', 'pubDate', 'creator'];

    public function build(array $items): array;
}
