<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseSwitcher
{
    /**
     * Switch the default database connection to a tenant database.
     *
     * @param string $dbName
     * @return void
     */
    public static function switch(string $dbName)
    {
        // Update the default mysql connection database
        Config::set('database.connections.mysql.database', $dbName);

        // Disconnect from the current database to ensure the next query uses the new config
        DB::purge('mysql');
        
        // Reconnect to verify
        DB::reconnect('mysql');
    }

    /**
     * Switch back to the main database.
     *
     * @return void
     */
    public static function reset()
    {
        self::switch(env('DB_DATABASE', 'laravel'));
    }
}
