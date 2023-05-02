<?php

namespace App\Application;

use App\Domain\DataBuilderInterface;
use App\Domain\CsvHelperInterface;
use App\Domain\RssFeedDataProviderInterface;

class RssDataFeedService
{
    private CsvHelperInterface $csvHelper;
    private RssFeedDataProviderInterface $feedDataProvider;
    private DataBuilderInterface $dataBuilder;

    public function __construct(
        CsvHelperInterface $csvHelper,
        RssFeedDataProviderInterface $feedDataProvider,
        DataBuilderInterface $dataBuilder
    ) {
        $this->csvHelper = $csvHelper;
        $this->feedDataProvider = $feedDataProvider;
        $this->dataBuilder = $dataBuilder;
    }

    public function exportToCsv(string $url, string $fileName): void
    {
        $feedData = $this->feedDataProvider->getFeedData($url);

        $this->csvHelper->export(
            $fileName,
            DataBuilderInterface::CSV_HEADERS,
            $this->dataBuilder->build($feedData)
        );
    }

    public function appendToCsv(string $url, string $fileName): void
    {
        $feedData = $this->feedDataProvider->getFeedData($url);
        $this->csvHelper->append(
            $fileName,
            $this->dataBuilder->build($feedData)
        );
    }
}
