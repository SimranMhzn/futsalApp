<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'], 
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '9811111111',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin', 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
