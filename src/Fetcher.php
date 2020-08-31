<?php

namespace Goudenvis\CockpitData;

class Fetcher
{
    /*
     * CockpitFetcher
     *
     * Fetch the data from remote table
     */
    private static function cockpitFetcher($table = 'Vacancies', $startDate = null)
    {
        $data = [];
        try {
            $hostname = env('COCKPIT_DATABASE_HOST');
            $dbname = env('COCKPIT_DATABASE_NAME');
            $username = env('COCKPIT_DATABASE_USERNAME');
            $pwd = env('COCKPIT_DATABASE_PASSWORD');
            $dbh = new PDO ("dblib:version=8.0;charset=UTF-8;host={$hostname};dbname={$dbname}", $username, $pwd);

            if ($startDate != null) {
                $query = 'SELECT * FROM [cockpit-etl-europlanit].dbo.' . $table . " WHERE DatetimeCreated > " . "'$startDate'";
            } else {
                $query = 'SELECT * FROM [cockpit-etl-europlanit].dbo.' . $table;
            }

            foreach($dbh->query($query) as $row) {
                $keys = collect($row)->keys();

                $cleanedKeys = $keys->map(function($key) {
                    return is_string($key) ? $key : null;
                })->filter();

                $data[] = collect($row)->only($cleanedKeys)->toArray();
            }
        } catch (PDOException $e) {
            Log::error($e->getMessage());
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }
        self::$cockpitData = collect($data);
    }
}
