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
        if (!Schema::hasTable('wholesale_stocks')) {
            Schema::create('wholesale_stocks', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('admin_id')->nullable()->index();
                $table->unsignedBigInteger('firm_id')->nullable()->index();
                $table->unsignedBigInteger('item_product_data_id')->nullable()->index();
                $table->unsignedBigInteger('category_id')->nullable()->index();
                $table->unsignedBigInteger('subcategory_id')->nullable()->index();
                $table->unsignedBigInteger('purity_id')->nullable()->index();
                $table->string('item_name');
                $table->string('pre_code')->index();

                $table->decimal('total_quantity', 10, 2)->default(0);
                $table->decimal('available_quantity', 10, 2)->default(0);

                $table->decimal('total_gross_weight', 12, 3)->default(0);
                $table->decimal('available_gross_weight', 12, 3)->default(0);

                $table->decimal('total_net_weight', 12, 3)->default(0);
                $table->decimal('available_net_weight', 12, 3)->default(0);

                $table->decimal('total_fine_weight', 12, 3)->default(0);
                $table->decimal('available_fine_weight', 12, 3)->default(0);

                $table->timestamps();
                $table->softDeletes();

                $table->index(['firm_id', 'pre_code', 'purity_id'], 'idx_ws_firm_pre_purity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wholesale_stocks');
    }
};
