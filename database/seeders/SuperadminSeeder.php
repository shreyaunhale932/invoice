<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'superadmin'],
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'admin@example.com',
                'phone' => '9999999999',
                'role' => 'superadmin',
                'password' => 'superadmin',
                'status' => 1
            ]
        );
    }
}
