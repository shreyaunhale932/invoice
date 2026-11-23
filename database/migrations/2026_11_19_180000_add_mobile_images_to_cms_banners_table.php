<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cms_banners', function (Blueprint $table) {
            $table->string('mob_img1')->nullable();
            $table->string('mob_img2')->nullable();
            $table->string('mob_img3')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cms_banners', function (Blueprint $table) {
            $table->dropColumn(['mob_img1', 'mob_img2', 'mob_img3']);
        });
    }
};
