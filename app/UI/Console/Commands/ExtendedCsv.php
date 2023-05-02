<?php

namespace App\UI\Console\Commands;

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
        if (!$this->validator->validate($this->arguments())) {
            $this->error('Invalid command arguments.');
            return;
        }

        try {
            $this->rssDataFeedService->appendToCsv(
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
