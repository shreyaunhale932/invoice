<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class InvoiceColumnSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         //
//     }
// }
use App\Models\InvoiceColumn;
use Illuminate\Database\Seeder;

class InvoiceColumnSeeder extends Seeder
{
    public function run()
    {
        // $defaultColumns = [
        //     ['name' => 'Item', 'type' => 'text', 'is_custom' => false, 'is_visible' => true, 'position' => 1],
        //     ['name' => 'HSN', 'type' => 'text', 'is_custom' => false, 'is_visible' => true, 'position' => 2],
        //     ['name' => 'Quantity', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 3],
        //     ['name' => 'Rate', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 4],
        //     ['name' => 'Discount', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 5],
        //     ['name' => 'GST %', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 6],
        //     ['name' => 'Amount', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 7],
        //     ['name' => 'CGST', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 8],
        //     ['name' => 'SGST', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 9],
        //     ['name' => 'IGST', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 10],
        //     ['name' => 'Total', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 11],
        // ];
         $defaultColumns = [
    ['name' => 'Item', 'key' => 'item', 'type' => 'text', 'is_custom' => false, 'is_visible' => true, 'position' => 1],
    ['name' => 'HSN', 'key' => 'hsn', 'type' => 'text', 'is_custom' => false, 'is_visible' => true, 'position' => 2],
    ['name' => 'Quantity', 'key' => 'quantity', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 3],
    ['name' => 'Rate', 'key' => 'rate', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 4],
    ['name' => 'Discount', 'key' => 'discount', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 5],
    ['name' => 'GST %', 'key' => 'tax_pct', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 6],
    ['name' => 'Amount', 'key' => 'amount', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 7],
    ['name' => 'CGST', 'key' => 'cgst', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 8],
    ['name' => 'SGST', 'key' => 'sgst', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 9],
    ['name' => 'IGST', 'key' => 'igst', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 10],
    ['name' => 'Total', 'key' => 'total', 'type' => 'number', 'is_custom' => false, 'is_visible' => true, 'position' => 11],
];

        // Replace this with an actual admin id if needed
        $adminId = 1;

        foreach ($defaultColumns as $column) {
            InvoiceColumn::create(array_merge($column, ['user_id' => $adminId]));
        }
    }
}

