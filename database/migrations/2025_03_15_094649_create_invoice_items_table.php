<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hsn_code_id')->nullable()->constrained('hsn_codes')->onDelete('set null');
            $table->enum('type', ['product', 'service'])->default('product');
        });
    }

    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['hsn_code_id']);
            $table->dropColumn(['admin_id', 'hsn_code_id', 'type']);
        });
    }
};
