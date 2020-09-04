<?php

namespace Goudenvis\CockpitData\Jobs;

use App\Helpers\QueuedCommands;
use Goudenvis\CockpitData\Fetcher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Base implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 2500;

    protected $tables;
    protected $history;
    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function __construct($tables = [], $history = false)
    {
        $this->tables = $tables;
        $this->history = $history;
    }

    public function handle()
    {
        foreach ($this->tables as $table) {
            Fetcher::run($table, $this->history);
        }
    }

    public function tags()
    {
        return collect($this->tables)->pluck('cockpit_table_name')->toArray();
    }
}
