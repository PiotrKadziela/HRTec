<?php

namespace Tests\Unit\Infrastructure;

use App\Infrastructure\Laravel\Exceptions\NoDataProvidedException;
use App\Infrastructure\RssFeedDataProvider;
use PHPUnit\Framework\TestCase;
use SimplePie\SimplePie;
use Vedmant\FeedReader\FeedReader;

class RssFeedDataProviderTest extends TestCase
{
    private const FEED_URL = 'https://example-url.com/';
    private const FEED_DATA = ['example' => 'data'];

    private FeedReader $reader;
    private RssFeedDataProvider $dataProvider;
    private SimplePie $pie;

    protected function setUp(): void
    {
        $this->reader = $this->createMock(FeedReader::class);
        $this->pie = $this->createMock(SimplePie::class);

        $this->reader->expects($this->once())
            ->method('read')
            ->with(self::FEED_URL)
            ->willReturn($this->pie);

        $this->dataProvider = new RssFeedDataProvider($this->reader);
    }

    /**
     * @test
     */
    public function shouldReturnData(): void
    {
        $this->pie->expects($this->once())
            ->method('get_items')
            ->willReturn(self::FEED_DATA);

        self::assertSame(self::FEED_DATA, $this->dataProvider->getFeedData(self::FEED_URL));
    }

    /**
     * @test
     */
    public function shouldThrowException(): void
    {
        $this->pie->expects($this->once())
            ->method('get_items')
            ->willReturn(null);

        $this->expectException(NoDataProvidedException::class);
        $this->expectExceptionMessage('No RSS feed data provided.');

        $this->dataProvider->getFeedData(self::FEED_URL);
    }
}
