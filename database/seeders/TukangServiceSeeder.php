<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;

class TukangServiceSeeder extends Seeder
{
    public function run(): void
    {
        $tukangs = User::where('role', 'tukang')->get();
        $services = Service::all();

        foreach ($tukangs as $tukang) {
            // Setiap tukang akan menawarkan 3 sampai 8 layanan secara acak
            $offeredServices = $services->random(rand(3, 8));

            foreach ($offeredServices as $service) {
                // Attach ke tabel pivot dengan data tambahan
                $tukang->offeredServices()->attach($service->id, [
                    'description' => 'Layanan profesional ' . $service->name . ' oleh ' . $tukang->name,
                    // Buat harga sedikit bervariasi dari harga dasar
                    'price' => $service->base_price + fake()->numberBetween(-10, 20) * 1000,
                    'status' => 'approved', // Langsung disetujui untuk data dummy
                ]);
            }
        }
    }
}