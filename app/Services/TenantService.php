<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Exception;

class TenantService
{
    /**
     * Create a new database for the tenant admin and run migrations.
     *
     * @param Admin $admin
     * @return string The created database name
     * @throws Exception
     */
    public function createTenant(Admin $admin)
    {
        $dbName = 'invoice_admin_' . $admin->id;

        Log::info("Starting tenant creation for admin: {$admin->id}, database: {$dbName}");

        // try {
            // 1. Create the database
            DB::statement("CREATE DATABASE IF NOT EXISTS `{$dbName}`");
            Log::info("Database created successfully: {$dbName}");

            // 2. Switch to the new database
            DatabaseSwitcher::switch($dbName);
            Log::info("Switched connection to: {$dbName}");

            // 3. Run migrations on the new database
            // Explicitly set the connection to 'mysql' which we just redirected
            $exitCode = Artisan::call('migrate', [
                '--force' => true,
                '--database' => 'mysql',
            ]);

            $output = Artisan::output();

            Log::info("Migrations completed for tenant: {$dbName}", [
                'exit_code' => $exitCode,
                'output' => $output
            ]);

            if ($exitCode !== 0) {
                throw new Exception("Migration failed for tenant {$dbName}. Output: " . $output);
            }

            // 4. Reset to the main database
            DatabaseSwitcher::reset();
            Log::info("Reset connection to main database");

            return $dbName;
        // } catch (Exception $e) {
        //     Log::error("Failed to create tenant for admin: {$admin->id}", [
        //         'database' => $dbName,
        //         'error' => $e->getMessage(),
        //         'trace' => $e->getTraceAsString()
        //     ]);
        //     DatabaseSwitcher::reset();
        //     throw $e;
        // }
    }
}
