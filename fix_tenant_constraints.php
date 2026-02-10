<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;
use App\Services\DatabaseSwitcher;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$admins = Admin::all();

foreach ($admins as $admin) {
    if (!$admin->db_name) continue;

    echo "Processing database: {$admin->db_name}...\n";

    try {
        DatabaseSwitcher::switch($admin->db_name);

        // Standard Laravel foreign key names
        $constraints = [
            'customers' => 'customers_admin_id_foreign',
            'clients' => 'clients_admin_id_foreign',
            'custom_field_definitions' => 'custom_field_definitions_admin_id_foreign',
        ];

        foreach ($constraints as $table => $constraint) {
            if (Schema::hasTable($table)) {
                // Check if constraint exists (MySQL specific check)
                $exists = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_SCHEMA = ? 
                    AND TABLE_NAME = ? 
                    AND CONSTRAINT_NAME = ?
                ", [$admin->db_name, $table, $constraint]);

                if (!empty($exists)) {
                    echo "  Dropping constraint {$constraint} on table {$table}...\n";
                    Schema::table($table, function ($blueprint) use ($constraint) {
                        $blueprint->dropForeign($constraint);
                    });
                } else {
                    echo "  Constraint {$constraint} not found on table {$table}.\n";
                }
            } else {
                echo "  Table {$table} does not exist.\n";
            }
        }

    } catch (\Exception $e) {
        echo "  Error: " . $e->getMessage() . "\n";
    }
}

echo "Done.\n";
