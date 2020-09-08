<?php
/*
 * Configuration for the Cockpit Data extraction
 * Use:
 *  'CockpitDataTable' => [
 *      'class'   => 'CockpitDataClassName', //Classname without the full namespace
 *      'internal_database => 'local_database_name' //Optional. Use for pivottables, without model
 *      'columns' => [
 *              'cockpitColumnName' => 'database_table_name'
 *      ]
 * ]
 */

return [
    /*
     * Define the credentials in the database of Cockpit.
     * Please contact your contactperson if you don't have access (yet).
     *
     * Note: The database will only be accessable on devices that are white-listed
     */
    'database' => [
        'host' => env('COCKPIT_DATA_DATABASE_HOST', null),
        'name' => env('COCKPIT_DATA_DATABASE_NAME', null),
        'username' => env('COCKPIT_DATA_DATABASE_USERNAME', null),
        'password' => env('COCKPIT_DATA_DATABASE_PASSWORD', null)
    ],

    /*
     * Define the amount of days that will be used to get the data.
     *
     * This number is overruled when the history option is chosen.
     * (in that case all data will be fetched)
     */
    'history' => env('COCKPIT_DATA_HISTORY', 2),

    /*
     * Define location where the models are placed.
     * Update when the models are moved.
     */
    'model-location' => 'Goudenvis\CockpitData\Models\\',

    'dispatch_jobs' => env('COCKPIT_DATA_DISPATCH_JOBS', false)
];
