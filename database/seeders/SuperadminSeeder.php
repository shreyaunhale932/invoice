<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::updateOrCreate(
        //     ['username' => 'superadmin'],
        //     [
        //         'name' => 'Super Admin',
        //         'username' => 'superadmin',
        //         'email' => 'admin@example.com',
        //         'phone' => '9999999999',
        //         'role' => 'superadmin',
        //         'password' => 'superadmin',
        //         'status' => 1
        //     ]
        // );

        User::updateOrCreate(
            ['username' => 'superadmin',
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'admin@example.com',
                'phone' => '9999999999', ],
            [

                'role' => 'superadmin',
                'password' => 'superadmin',
                'status' => 1,
            ]
        );
    }
}
