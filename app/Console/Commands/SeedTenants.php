<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use App\Services\DatabaseSwitcher;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SeedTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:seed {--class= : The class name of the root seeder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed all tenant databases';

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

        $this->info('Starting seeding for ' . $admins->count() . ' tenants...');

        foreach ($admins as $admin) {
            if (!$admin->db_name) {
                $this->warn("Admin {$admin->name} (ID: {$admin->id}) has no database name defined. Skipping.");
                continue;
            }

            $this->info("--------------------------------------------------");
            $this->info("Seeding database: {$admin->db_name} (Admin: {$admin->name})");

            try {
                DatabaseSwitcher::switch($admin->db_name);

                $options = [
                    '--force' => true, // Required for production
                ];

                if ($this->option('class')) {
                    $options['--class'] = $this->option('class');
                }

                Artisan::call('db:seed', $options);

                $this->info(Artisan::output());
                $this->info("Successfully seeded {$admin->db_name}");

            } catch (\Exception $e) {
                $this->error("Failed to seed {$admin->db_name}: " . $e->getMessage());
                Log::error("Tenant Seeding Failed for {$admin->db_name}: " . $e->getMessage());
            }
        }

        // Reset back to landlord database
        DatabaseSwitcher::reset();
        $this->info("--------------------------------------------------");
        $this->info('All tenant seedings completed.');
    }
}
