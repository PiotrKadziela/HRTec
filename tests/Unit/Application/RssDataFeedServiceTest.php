<?php

namespace Tests\Unit\Application;

use App\Application\RssDataFeedService;
use App\Domain\DataBuilderInterface;
use App\Infrastructure\CsvHelper;
use App\Infrastructure\DataBuilder;
use App\Infrastructure\RssFeedDataProvider;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class RssDataFeedServiceTest extends TestCase
{
    private const FEED_URL = 'https://example-url.com/';
    private const FILE_NAME = 'example.csv';
    private const FEED_DATA = ['example' => 'data'];

    private CsvHelper $csvHelper;
    private RssDataFeedService $service;

    protected function setUp(): void
    {
        $this->csvHelper = $this->createMock(CsvHelper::class);
        $dataBuilder = $this->createMock(DataBuilder::class);
        $feedDataProvider = $this->createMock(RssFeedDataProvider::class);

        $this->service = new RssDataFeedService(
            $this->csvHelper,
            $feedDataProvider,
            $dataBuilder
        );

        $feedDataProvider->expects($this->once())
            ->method('getFeedData')
            ->with(self::FEED_URL)
            ->willReturn(self::FEED_DATA);

        $dataBuilder->expects($this->once())
            ->method('build')
            ->with(self::FEED_DATA)
            ->willReturn(self::FEED_DATA);
    }

    /**
     * @test
     * @throws Exception
     */
    public function shouldExportFeedDataToCsv(): void
    {
        $this->csvHelper->expects($this->once())
            ->method('export')
            ->with(
                self::FILE_NAME,
                DataBuilderInterface::CSV_HEADERS,
                self::FEED_DATA
            );

        $this->service->exportToCsv(self::FEED_URL, self::FILE_NAME);
    }

    /**
     * @test
     * @throws Exception
     */
    public function shouldAppendFeedDataIntoCsv(): void
    {
        $this->csvHelper->expects($this->once())
            ->method('append')
            ->with(
                self::FILE_NAME,
                $this->anything()
            );

        $this->service->appendToCsv(self::FEED_URL, self::FILE_NAME);
    }
}
