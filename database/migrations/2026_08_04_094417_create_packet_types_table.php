<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('packet_types')) {
            Schema::create('packet_types', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('firm_id');
                $table->string('name');
                $table->string('short_code')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            });
        }

        // Seed with Diamond and Stone/Other for all existing firms
        if (Schema::hasTable('firms')) {
            $firms = DB::table('firms')->get();
            foreach ($firms as $firm) {
                DB::table('packet_types')->insertOrIgnore([
                    [
                        'firm_id' => $firm->id,
                        'name' => 'Diamond',
                        'short_code' => 'DIA',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'firm_id' => $firm->id,
                        'name' => 'Stone/Other',
                        'short_code' => 'STN',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packet_types');
    }
};
