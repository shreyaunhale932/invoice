<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['stones', 'clarities', 'colors', 'cuts', 'mms', 'chalnis', 'shapes'];

        foreach ($tables as $table) {
            if (!Schema::hasTable($table)) {
                Schema::create($table, function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('firm_id');
                    $table->string('name');
                    $table->string('short_code')->nullable();
                    $table->timestamps();
                    $table->softDeletes();
                    $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
                });
            }
        }
    }

    public function down(): void
    {
        $tables = ['stones', 'clarities', 'colors', 'cuts', 'mms', 'chalnis', 'shapes'];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
