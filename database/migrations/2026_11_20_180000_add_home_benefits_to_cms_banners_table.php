<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cms_banners', function (Blueprint $table) {
            $table->string('benefit_h1')->nullable();
            $table->text('benefit_t1')->nullable();
            $table->string('benefit_h2')->nullable();
            $table->text('benefit_t2')->nullable();
            $table->string('benefit_h3')->nullable();
            $table->text('benefit_t3')->nullable();
            $table->string('benefit_h4')->nullable();
            $table->text('benefit_t4')->nullable();
            $table->string('benefit_stat1_value', 100)->nullable();
            $table->string('benefit_stat1_label')->nullable();
            $table->string('benefit_stat2_value', 100)->nullable();
            $table->string('benefit_stat2_label')->nullable();
            $table->string('benefit_stat3_value', 100)->nullable();
            $table->string('benefit_stat3_label')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cms_banners', function (Blueprint $table) {
            $table->dropColumn([
                'benefit_h1',
                'benefit_t1',
                'benefit_h2',
                'benefit_t2',
                'benefit_h3',
                'benefit_t3',
                'benefit_h4',
                'benefit_t4',
                'benefit_stat1_value',
                'benefit_stat1_label',
                'benefit_stat2_value',
                'benefit_stat2_label',
                'benefit_stat3_value',
                'benefit_stat3_label',
            ]);
        });
    }
};
