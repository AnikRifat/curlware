<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'show product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);

    }
}
