<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 20) as $index) {
            DB::table('products')->insert([
                'name' => Str::random(),
                'slug' => Str::slug(Str::random()),
                'description' => Str::random(),
                'price' => rand(10, 1000),
                'image' => 'placeholder.jpg',
                'added_by' => 1,
                'status' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


    }
}
