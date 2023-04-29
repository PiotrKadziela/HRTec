<?php

namespace App\Console\Commands;

use App\Application\RssDataFeedService;
use App\Validation\CsvCommandValidator;
use Illuminate\Console\Command;

class ExtendedCsv extends Command
{
    protected $signature = 'csv:extended {url} {path}';
    protected $description = 'Append RSS feed data to CSV';

    private RssDataFeedService $rssDataFeedService;
    private CsvCommandValidator $validator;

    public function __construct(
        RssDataFeedService $rssDataFeedService,
        CsvCommandValidator $validator
    ) {
        parent::__construct();
        $this->rssDataFeedService = $rssDataFeedService;
        $this->validator = $validator;
    }

    public function handle(): void
    {
        $url = $this->argument('url');
        $path = $this->argument('path');

        if (!$this->validator->isUrlValid($url)) {
            $this->error('Incorrect feed url.');
            return;
        }

        if (!$this->validator->isCsvFilePathValid($path)) {
            $this->error('Incorrect file path.');
            return;
        }

        try {
            $this->rssDataFeedService->appendToCsv($url, $path);
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());
            return;
        }

        $this->info('Data saved successfully!');
    }
}
