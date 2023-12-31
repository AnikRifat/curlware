<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin'])->givePermissionTo([1, 2, 3, 4]);
        Role::create(['name' => 'manager'])->givePermissionTo([1, 2, 3]);
        Role::create(['name' => 'employee'])->givePermissionTo([2]);

    }
}
