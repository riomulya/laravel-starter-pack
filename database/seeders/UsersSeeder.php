<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed an admin user
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed a regular user
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('user'),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed a staff member
        DB::table('users')->insert([
            'name' => 'Staff Member',
            'email' => 'staff@example.com',
            'password' => Hash::make('staff'),
            'role' => 'staff',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed a manager
        DB::table('users')->insert([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('manager'),
            'role' => 'manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
