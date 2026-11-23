<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cms_banners', function (Blueprint $table) {
            $table->string('ai_tools_title')->nullable()->after('dashboard_image');
            $table->longText('ai_tools_content')->nullable()->after('ai_tools_title');
        });
    }

    public function down(): void
    {
        Schema::table('cms_banners', function (Blueprint $table) {
            $table->dropColumn(['ai_tools_title', 'ai_tools_content']);
        });
    }
};
