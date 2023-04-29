<?php

namespace App\Infrastructure;

use App\Domain\RssFeedDataProviderInterface;
use App\Exceptions\NoDataProvidedException;
use SimplePie\Item;
use Vedmant\FeedReader\FeedReader;

class RssFeedDataProvider implements RssFeedDataProviderInterface
{
    /**
     * @param string $feedUrl
     * @return array<Item>
     * @throws NoDataProvidedException
     */
    public function getFeedData(string $feedUrl): array
    {
        $reader = new FeedReader(app());
        $data = $reader->read($feedUrl)->get_items();

        if (is_null($data)) {
            throw new NoDataProvidedException('No RSS feed data provided.');
        }

        return $data;
    }
}
