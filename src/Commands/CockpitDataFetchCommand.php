<?php

namespace Goudenvis\CockpitData\Commands;

use Goudenvis\CockpitData\Fetcher;
use Illuminate\Console\Command;

class CockpitDataFetchCommand extends Command
{
    public $signature = 'cockpit:data {--history} {--t|table=} {--d|direct}';

    public $description = 'Fetch data from Cockpit use \'--table="" to fetch a specific table ';

    public function handle()
    {
        $start = now();

        $tables = collect(config('cockpit-data-tables'));

//        \DB::enableQueryLog();

        $tables->each(function($table) {
            Fetcher::run($table, $this->option('history'));
        });

//        $this->comment(count(\DB::getQueryLog()) . ' queries has run');
        $this->comment('All done in ' . now()->diffInSeconds($start) . ' seconds');
    }
}
