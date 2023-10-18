<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin user',
                'username' => 'admin',
                'email' => 'admin@ecomm.test',
                'role' => 'admin',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Vendor user',
                'username' => 'vendor',
                'email' => 'vendor@ecomm.test',
                'role' => 'vendor',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@ecomm.test',
                'role' => 'user',
                'password' => bcrypt('password')
            ]
        ]);
    }
}
