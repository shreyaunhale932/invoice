<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AccountingSeeder;
use Database\Seeders\SuperadminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountingSeeder::class,
            SuperadminSeeder::class,
        ]);
    }
}

