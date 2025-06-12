<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        ServiceCategory::firstOrCreate(['name' => 'Repairing'], ['slug' => 'repairing']);
        ServiceCategory::firstOrCreate(['name' => 'Cleaning'], ['slug' => 'cleaning']);
    }
}