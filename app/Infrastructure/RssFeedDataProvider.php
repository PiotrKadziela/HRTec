<?php

namespace App\Infrastructure;

use App\Domain\RssFeedDataProviderInterface;
use App\Infrastructure\Laravel\Exceptions\NoDataProvidedException;
use SimplePie\Item;
use Vedmant\FeedReader\FeedReader;

class RssFeedDataProvider implements RssFeedDataProviderInterface
{
    private FeedReader $reader;

    public function __construct(FeedReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param string $feedUrl
     * @return array<Item>
     * @throws NoDataProvidedException
     */
    public function getFeedData(string $feedUrl): array
    {
        $data = $this->reader->read($feedUrl)->get_items();

        if (is_null($data)) {
            throw new NoDataProvidedException('No RSS feed data provided.');
        }

        return $data;
    }
}
