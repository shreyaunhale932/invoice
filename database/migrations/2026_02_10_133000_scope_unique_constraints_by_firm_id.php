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
        // Helper function to safely drop unique index
        $dropUniqueIfExist = function($table, $indexName) {
            $exists = count(DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName])) > 0;
            if ($exists) {
                Schema::table($table, function (Blueprint $table) use ($indexName) {
                    $table->dropUnique($indexName);
                });
            }
        };

        // 1. item_product_data: product_code
        $dropUniqueIfExist('item_product_data', 'item_product_data_product_code_unique');
        Schema::table('item_product_data', function (Blueprint $table) {
             // Check if new index exists to avoid duplication error on re-run
             $exists = count(DB::select("SHOW INDEX FROM item_product_data WHERE Key_name = 'item_product_data_firm_product_code_unique'")) > 0;
             if (!$exists) {
                $table->unique(['firm_id', 'product_code'], 'item_product_data_firm_product_code_unique');
             }
        });

        // 2. products: barcode AND pre_code+post_code
        $dropUniqueIfExist('products', 'products_barcode_unique');
        $dropUniqueIfExist('products', 'products_pre_post_code_unique');
        
        Schema::table('products', function (Blueprint $table) {
            $existsBarcode = count(DB::select("SHOW INDEX FROM products WHERE Key_name = 'products_firm_barcode_unique'")) > 0;
            if (!$existsBarcode) {
                $table->unique(['firm_id', 'barcode'], 'products_firm_barcode_unique');
            }

            $existsPrePost = count(DB::select("SHOW INDEX FROM products WHERE Key_name = 'products_firm_pre_post_code_unique'")) > 0;
            if (!$existsPrePost) {
                $table->unique(['firm_id', 'pre_code', 'post_code'], 'products_firm_pre_post_code_unique');
            }
        });

        // 3. accounts: code
        $dropUniqueIfExist('accounts', 'accounts_code_unique');
        Schema::table('accounts', function (Blueprint $table) {
             $exists = count(DB::select("SHOW INDEX FROM accounts WHERE Key_name = 'accounts_firm_code_unique'")) > 0;
             if (!$exists) {
                 $table->unique(['firm_id', 'code'], 'accounts_firm_code_unique');
             }
        });

        // 4. clients: email
        $dropUniqueIfExist('clients', 'clients_email_unique');
        Schema::table('clients', function (Blueprint $table) {
            $exists = count(DB::select("SHOW INDEX FROM clients WHERE Key_name = 'clients_firm_email_unique'")) > 0;
             if (!$exists) {
                $table->unique(['firm_id', 'email'], 'clients_firm_email_unique');
             }
        });

        // 5. invoice_template_settings
        $dropUniqueIfExist('invoice_template_settings', 'unique_template_setting');
        Schema::table('invoice_template_settings', function (Blueprint $table) {
             $exists = count(DB::select("SHOW INDEX FROM invoice_template_settings WHERE Key_name = 'unique_template_setting_firm'")) > 0;
             if (!$exists) {
                 $table->unique(['firm_id', 'section_key', 'field_key'], 'unique_template_setting_firm');
             }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Helper function to safely drop unique index
        $dropUniqueIfExist = function($table, $indexName) {
            $exists = count(DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$indexName])) > 0;
            if ($exists) {
                Schema::table($table, function (Blueprint $table) use ($indexName) {
                    $table->dropUnique($indexName);
                });
            }
        };

        $dropUniqueIfExist('item_product_data', 'item_product_data_firm_product_code_unique');
        $dropUniqueIfExist('products', 'products_firm_barcode_unique');
        $dropUniqueIfExist('products', 'products_firm_pre_post_code_unique');
        $dropUniqueIfExist('accounts', 'accounts_firm_code_unique');
        $dropUniqueIfExist('clients', 'clients_firm_email_unique');
        $dropUniqueIfExist('invoice_template_settings', 'unique_template_setting_firm');
    }
};
