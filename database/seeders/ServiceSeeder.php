<?php
// database/seeders/ServiceSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $repairingCategory = ServiceCategory::where('slug', 'repairing')->first();
        $cleaningCategory = ServiceCategory::where('slug', 'cleaning')->first();

        // PASTIKAN SEMUA KUNCI MENGGUNAKAN 'service_category_id'
        $services = [
            // Repairing Services
            ['name' => 'Tembok', 'service_category_id' => $repairingCategory->id, 'base_price' => 50000, 'icon_path' => '/images/tembok.svg'],
            ['name' => 'Kebocoran', 'service_category_id' => $repairingCategory->id, 'base_price' => 75000, 'icon_path' => '/images/kebocoran.svg'],
            ['name' => 'Keramik', 'service_category_id' => $repairingCategory->id, 'base_price' => 60000, 'icon_path' => '/images/keramik.svg'],
            ['name' => 'Listrik', 'service_category_id' => $repairingCategory->id, 'base_price' => 80000, 'icon_path' => '/images/listrik.svg'],
            ['name' => 'Air', 'service_category_id' => $repairingCategory->id, 'base_price' => 70000, 'icon_path' => '/images/air.svg'],
            ['name' => 'Pintu', 'service_category_id' => $repairingCategory->id, 'base_price' => 55000, 'icon_path' => '/images/pintu.svg'],
            ['name' => 'Pagar', 'service_category_id' => $repairingCategory->id, 'base_price' => 90000, 'icon_path' => '/images/pagar.svg'],
            ['name' => 'Kanopi', 'service_category_id' => $repairingCategory->id, 'base_price' => 120000, 'icon_path' => '/images/kanopi.svg'],
            ['name' => 'Jendela', 'service_category_id' => $repairingCategory->id, 'base_price' => 65000, 'icon_path' => '/images/jendela.svg'],
            ['name' => 'Atap', 'service_category_id' => $repairingCategory->id, 'base_price' => 150000, 'icon_path' => '/images/atap.svg'],

            // Cleaning Services
            ['name' => 'Kamar', 'service_category_id' => $cleaningCategory->id, 'base_price' => 50000, 'icon_path' => '/images/kamar.svg'],
            ['name' => 'Sofa', 'service_category_id' => $cleaningCategory->id, 'base_price' => 80000, 'icon_path' => '/images/sofa.svg'],
            ['name' => 'Kasur', 'service_category_id' => $cleaningCategory->id, 'base_price' => 100000, 'icon_path' => '/images/kasur.svg'],
            ['name' => 'Karpet', 'service_category_id' => $cleaningCategory->id, 'base_price' => 70000, 'icon_path' => '/images/karpet.svg'],
            ['name' => 'Tandon', 'service_category_id' => $cleaningCategory->id, 'base_price' => 95000,     'icon_path' => '/images/tandon.svg'],
            ['name' => 'Dapur', 'service_category_id' => $cleaningCategory->id, 'base_price' => 75000, 'icon_path' => '/images/dapur.svg'],
            ['name' => 'Garasi', 'service_category_id' => $cleaningCategory->id, 'base_price' => 60000, 'icon_path' => '/images/garasi.svg'],
            ['name' => 'Halaman', 'service_category_id' => $cleaningCategory->id, 'base_price' => 85000, 'icon_path' => '/images/halaman.svg'],
            ['name' => 'Toilet', 'service_category_id' => $cleaningCategory->id, 'base_price' => 60000, 'icon_path' => '/images/toilet.svg'],
            ['name' => 'Full Clean', 'service_category_id' => $cleaningCategory->id, 'base_price' => 350000, 'icon_path' => '/images/fullclean.svg'],
        ];

        foreach ($services as $service) {
            // Gunakan firstOrCreate untuk menghindari duplikat jika seeder dijalankan lagi
            Service::firstOrCreate(['name' => $service['name']], $service);
        }
    }
}