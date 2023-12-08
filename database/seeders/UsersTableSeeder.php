<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'phone' => 01643675060,
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'phone' => 01643675061,
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);

        User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@gmail.com',
            'phone' => 01643675062,
            'password' => bcrypt('password'),
            'role' => 'employee',
        ]);

        User::factory(10)->create();
    }
}
