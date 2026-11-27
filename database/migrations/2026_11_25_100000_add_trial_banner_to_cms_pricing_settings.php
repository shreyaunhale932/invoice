<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cms_pricing_settings', function (Blueprint $table) {
            // Trial Banner Section fields
            $table->string('trial_eyebrow')->nullable()->default('A LITTLE ROOM TO EXPLORE');
            $table->string('trial_title')->nullable()->default('Meet JewelERP for 30 days.');
            $table->text('trial_description')->nullable();
            $table->json('trial_features')->nullable();
            $table->string('trial_button_text')->nullable()->default('Find Your Plan');
            $table->string('trial_button_link')->nullable()->default('#plans');
        });
    }

    public function down(): void
    {
        Schema::table('cms_pricing_settings', function (Blueprint $table) {
            $table->dropColumn([
                'trial_eyebrow',
                'trial_title',
                'trial_description',
                'trial_features',
                'trial_button_text',
                'trial_button_link',
            ]);
        });
    }
};
