<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Rename address1 to address
            $table->renameColumn('address1', 'address');

            // Drop address2
            $table->dropColumn('address2');

            // Add new fields
            $table->string('gst_no')->nullable();
            $table->string('adhaar_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('tan')->nullable();
            $table->date('dob')->nullable();
            $table->date('anniversary_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('address', 'address1');
            $table->text('address2')->nullable();

            $table->dropColumn(['gst_no', 'adhaar_no', 'pan_no', 'tan', 'dob', 'anniversary_date']);
        });
    }
};
