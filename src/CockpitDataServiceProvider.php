<?php

namespace Goudenvis\CockpitData\Commands;

use Illuminate\Console\Command;
use Goudenvis\CockpitData\Fetcher;
use Goudenvis\CockpitData\Jobs\Base;

class CockpitDataFetchCommand extends Command
{
    public $signature = 'cockpit:data {--history} {--t|table=} {--d|direct}';

    public $description = 'Fetch data from Cockpit use \'--table="" to fetch a specific table ';

    private $dedicated = [
        'CandidateStateTransistions'
    ];

    public function handle()
    {
        $start = now();

        $tables = $this->getTables();

//        \DB::enableQueryLog();

        if (
            (app()->environment() == 'production' && !$this->option('direct')) ||
            config('cockpitData.dispatch_jobs')
        ) {

            $tables->each(function($table) {
                Base::dispatch([$table], $this->option('history'))
                    ->onQueue('cockpit');
            });
        } else {
            $tables->each(function($table) {
                Fetcher::run($table, $this->option('history'));
            });
        }

//        $this->comment(count(\DB::getQueryLog()) . ' queries has run');
        $this->comment('All done in ' . now()->diffInSeconds($start) . ' seconds');
    }

    private function getTables()
    {
        if ($this->option('table')) {
            return collect(config('cockpit-data-tables'))
                ->where('cockpit_table_name', $this->option('table'))
                ->unique('cockpit_table_names');
        } else {
            return collect(config('cockpit-data-tables'));
        }
    }
}
