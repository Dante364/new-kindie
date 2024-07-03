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
        DB::table('parents')->insert([
            'name' => 'John Doe',
            'email' => 'parent@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password'),
        ]);
        Db::table('staff')->insert([
            'name' => 'Jane Doe',
            'email' => 'staff@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password'),
        ]);

        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password'),
        ]);
    }
}
