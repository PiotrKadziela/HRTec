<?php

namespace App\Domain;

use SimplePie\Item;

interface RssFeedDataProviderInterface
{
    /**
     * @param string $feedUrl
     * @return array<Item>
     */
    public function getFeedData(string $feedUrl): array;
}
