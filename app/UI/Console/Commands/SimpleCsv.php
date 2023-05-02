<?php

namespace App\UI\Console\Commands;

use App\Application\RssDataFeedService;
use App\Validation\CsvCommandValidator;
use Illuminate\Console\Command;

class SimpleCsv extends Command
{
    protected $signature = 'csv:simple {url} {path}';
    protected $description = 'Export RSS feed data to CSV';

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
        if (!$this->validator->validate($this->arguments())) {
            $this->error('Invalid command arguments.');
            return;
        }

        try {
            $this->rssDataFeedService->exportToCsv(
                $this->argument('url'),
                $this->argument('path')
            );
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());
            return;
        }

        $this->info('Data saved successfully!');
    }
}
