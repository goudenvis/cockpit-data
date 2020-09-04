<?php

namespace Goudenvis\CockpitData;

use DB;
use PDO;
use PDOException;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Fetcher
{
    private static $history = false;

    public function __construct()
    {
        $this->setClassNameDefault();
    }

    protected function setClassNameDefault()
    {
        self::$classNameDefault = config('cockpit-data.model-location');
    }

    public static function run($table, $history)
    {
        self::$history = $history;

        self::prepare($table);
    }

    /*
     * Prepare the config to get the data
     */
    private static function prepare($table)
    {
        if (self::$history && in_array('DatetimeCreated', $table['columns'])) {
            $startDate = today()->subDays(config('cockpit-data.history'));
        } else {
            $startDate = null;
        }

        $data = self::cockpitFetcher($table['cockpit_table_name'], $startDate);

        if (array_key_exists('pivot', $table)) {
            self::multiSaver($table, $data);
        } else {
            self::storer($table, $data);
        }
    }

    private static function multiSaver($tableContent,$data)
    {
        $class = config('cockpit-data.model-location') . $tableContent['class'];
        $class = new $class;

        $lastStored = $class::orderByDesc('id')->first();

        $result = $data->chunk(100)->map(function($collection) use ($tableContent, $lastStored) {
            return $collection->map(function ($row) use ($tableContent, $lastStored) {
                $newRow = self::cockpitDataCollector($row, $tableContent['columns']);

                if ($lastStored) {
                    //check witch id's already stored and remove
                    if ($lastStored->id < $newRow['id']) {
//                    if (!$alreadyStoredIds->contains($test['id'])) {
                        return $newRow;
                    }
                } else {
                    return $newRow;
                }
            })->filter();
        });

        // store everything left
        $result->map(function($collection) use ($class) {
            $table = $class->getTable();

            DB::table($table)->insert($collection->toArray());
        });
    }

    /*
     * classNameDefault
     *
     * Set default location for CockpitData models
     */
    private static $classNameDefault;

    /*
     * cockpitDataCollector
     *
     * Collect a single cockpitdata row
     */
    private static function cockpitDataCollector($rawContent, $columns)
    {
        return collect($rawContent)->mapWithKeys(function($value, $key) use ($columns) {
            if( array_key_exists($key, $columns)) {
                if ( Str::contains($columns[$key], ['datetime', '_date'])) {
                    return [$columns[$key] => Carbon::parse($value)];
                }
                return [$columns[$key] => $value];
            }
            return [];
        });
    }

    private static function storer($table, $data)
    {
        $unique_ident = $table['unique_id'] ?? 'id';
        $class = config('cockpit-data.model-location') . $table['class'];
        $tableContent = $table['columns'];
        dump($table['cockpit_table_name']);

        if (array_key_exists('pivot', $table)) {
            self::pivot($data, $unique_ident, $class, $tableContent);
        } else {
            self::single($data,$unique_ident,$class,$tableContent);
        }
    }

    private static function pivot(Collection $data, $unique_ident, $class, $tableContent)
    {
        if (!self::$history) {
            if ($class::count() > 0) {
                $data = $data->filter(function ($row) use ($class, $unique_ident, $tableContent) {
                    $row = self::cockpitDataCollector($row, $tableContent);

                    $first = $class::orderByDesc($unique_ident)->first();

                    return $row[$unique_ident] > $first->$unique_ident;
                });
            }
        }

        $data->each(function($row) use ($unique_ident, $class, $tableContent) {
            $row = self::cockpitDataCollector($row, $tableContent);
            $result = $class::firstWhere($unique_ident, $row[$unique_ident]);

            if ($result == null) {
                $class::create($row->toArray());
            } else {
                $result->update($row->toArray());
            }
        });
    }

    private static function single($data, $unique_ident, $class, $tableContent)
    {
        $data->each(function($row) use ($unique_ident, $class, $tableContent) {
            $row = self::cockpitDataCollector($row, $tableContent);
            $result = $class::firstWhere($unique_ident, $row[$unique_ident]);

            if ($result == null) {
                $class::create($row->toArray());
            } else {
                $result->update($row->toArray());
            }
        });
    }

    /*
     * CockpitFetcher
     *
     * Fetch the data from remote table
     */
    private static function cockpitFetcher($table = 'Vacancies', $startDate = null)
    {
        $data = [];
        try {
            $hostname = config('cockpit-data.database.host');
            $dbname = config('cockpit-data.database.name');
            $username = config('cockpit-data.database.username');
            $pwd = config('cockpit-data.database.password');

            if ($hostname == null || $dbname == null || $username == null || $pwd == null) {
                throw new \Exception('One or more credentials not found in the configuration');
            }

            $dbh = new PDO ("dblib:version=8.0;charset=UTF-8;host={$hostname};dbname={$dbname}", $username, $pwd);

            if ($startDate != null) {
                $query = 'SELECT * FROM [cockpit-etl-europlanit].dbo.' . $table . " WHERE DatetimeCreated > " . "'$startDate'";
            } else {
                $query = 'SELECT * FROM [cockpit-etl-europlanit].dbo.' . $table;
            }

            if ($dbh->query($query)) {
                foreach($dbh->query($query) as $row) {
                    $keys = collect($row)->keys();

                    $cleanedKeys = $keys->map(function($key) {
                        return is_string($key) ? $key : null;
                    })->filter();

                    $data[] = collect($row)->only($cleanedKeys)->toArray();
                }
            }

        } catch (PDOException $e) {
            Log::error($e->getMessage());
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }
        return collect($data);
    }
}
