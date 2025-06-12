<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ServiceCategorySeeder::class,
            ServiceSeeder::class,
            TukangServiceSeeder::class, // Harus setelah User dan Service dibuat
            OrderSeeder::class,         // Harus setelah semua data master dibuat
        ]);
    }
}