<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SimpleCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:simple';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Override data in PATH.csv';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dump('elo');
    }
}
