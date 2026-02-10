<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use App\Services\DatabaseSwitcher;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class MigrateTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {--fresh : Drop all tables and re-run all migrations} {--seed : Seed the database after migrating}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrations for all tenant databases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $admins = Admin::all();

        if ($admins->isEmpty()) {
            $this->info('No admins found.');
            return;
        }

        $this->info('Starting migrations for ' . $admins->count() . ' tenants...');

        foreach ($admins as $admin) {
            if (!$admin->db_name) {
                $this->warn("Admin {$admin->name} (ID: {$admin->id}) has no database name defined. Skipping.");
                continue;
            }

            $this->info("--------------------------------------------------");
            $this->info("Migrating database: {$admin->db_name} (Admin: {$admin->name})");

            try {
                DatabaseSwitcher::switch($admin->db_name);

                $options = [
                    '--force' => true, // Required for production
                ];

                if ($this->option('seed')) {
                    $options['--seed'] = true;
                }

                $command = $this->option('fresh') ? 'migrate:fresh' : 'migrate';

                Artisan::call($command, $options);

                $this->info(Artisan::output());
                $this->info("Successfully migrated {$admin->db_name}");

            } catch (\Exception $e) {
                $this->error("Failed to migrate {$admin->db_name}: " . $e->getMessage());
                Log::error("Tenant Migration Failed for {$admin->db_name}: " . $e->getMessage());
            }
        }

        // Reset back to landlord database
        DatabaseSwitcher::reset();
        $this->info("--------------------------------------------------");
        $this->info('All tenant migrations completed.');
    }
}
