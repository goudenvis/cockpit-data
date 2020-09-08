# Cockpit-data
A Laravel package to retrieve your production data from RecruitNow | Cockpit.

Once installed it will allow you to retrieve the data.

## Installation
Run:
``` bash
composer require goudenvis/cockpit-data
```
To get the config-files and migrations run:
``` bash
php artisan vendor:publish --provider="Goudenvis\CockpitData\CockpitDataServiceProvider"
```
Run the added migrations.

That's it!

## Configuration
##### Package settings
After running the *vendor:publish* command you will find two new config files.
In the first file *cockpit-data* you configure the connection with RecruitNow | Cockpit, determine the location for the Models and change the command-settings.
#### Tables
The second config file you find is the *cockpit-data-tables* file. This file will allow you to add or remove tables and columns in your import command.
Make sure you add the correct databasetables when you add tables or columns!


## Usage
To actualy get the data, run in the commandline:
``` bash
php artisan cockpit:data
```
The data will be fetched. If you changed the dispatch_jobs setting to true in the config file, the command will be handled in the queue. Also on default only the most recent changes will be fetched.
#### Options
There are several options for the command:
##### Direct
This option will allow you to run the command without running in the queue, but execute directly in the commandline. Most used for development.
``` bash
php artisan cockpit:data -d
```
or
``` bash
php artisan cockpit:data --direct
```
##### History
With this option the command will fetch all data that is available in the RecruitNow | Cockpit data tables.
*warning: This option will consume a lot of time.*
``` bash
php artisan cockpit:data -history
```

##### **Table**
In the case you want to only fetch a single table, you can choose this option. It requires a tablename. Use the same name as configured in the *cockpit-data-tables* config file under: *cockpit_table_name*
``` bash
php artisan cockpit:data -table Vacancies
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
