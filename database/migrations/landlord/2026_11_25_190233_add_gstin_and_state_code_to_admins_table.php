<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    $schema = Schema::connection('landlord');

    if (!$schema->hasColumn('admins', 'gstin')) {
        $schema->table('admins', function (Blueprint $table) {
            $table->string('gstin', 15)->nullable()->after('state');
        });
    }

    if (!$schema->hasColumn('admins', 'state_code')) {
        $schema->table('admins', function (Blueprint $table) {
            $table->string('state_code', 2)->nullable();
        });
    }
}

public function down(): void
{
    Schema::connection('landlord')->table('admins', function (Blueprint $table) {
        $table->dropColumn(['gstin', 'state_code']);
    });
}
};
