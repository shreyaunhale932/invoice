<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cms_solutions', function (Blueprint $table) {
            $table->dropColumn(['icon_class', 'highlighted']);
        });
    }

    public function down(): void
    {
        Schema::table('cms_solutions', function (Blueprint $table) {
            $table->string('icon_class', 80)->default('bi bi-stars');
            $table->boolean('highlighted')->default(false);
        });
    }
};
