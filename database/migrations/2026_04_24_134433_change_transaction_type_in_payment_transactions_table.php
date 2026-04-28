<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->string('transaction_type')->change();
        });
    }

    public function down()
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->enum('transaction_type', ['advance', 'udhaar_payment', 'refund', 'sale_payment'])->change();
        });
    }
};
