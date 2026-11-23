<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('cms_banners', 'dashboard_image')) {
            Schema::table('cms_banners', function (Blueprint $table) {
                $table->string('dashboard_image')->nullable()->after('image3');
            });
        }
    }

    public function down(): void
    {
        Schema::table('cms_banners', function (Blueprint $table) {
            $table->dropColumn('dashboard_image');
        });
    }
};
