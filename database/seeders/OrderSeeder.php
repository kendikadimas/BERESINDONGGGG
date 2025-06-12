<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $tukangs = User::where('role', 'tukang')->with('offeredServices')->get();

        if ($tukangs->isEmpty()) {
            $this->command->info('Tidak ada tukang yang bisa membuat order. Silakan jalankan TukangServiceSeeder terlebih dahulu.');
            return;
        }

        for ($i = 0; $i < 50; $i++) {
            $customer = $customers->random();
            $tukang = $tukangs->filter(fn ($t) => $t->offeredServices->isNotEmpty())->random();

            if ($tukang->offeredServices->isEmpty()) {
                continue;
            }

            $service = $tukang->offeredServices->random();

            // --- LOGIKA BARU DIMULAI DI SINI ---

            // 1. Tentukan status pekerjaan secara acak
            $orderStatus = fake()->randomElement(['pending', 'ongoing', 'completed', 'cancelled']);

            // 2. Tentukan status pembayaran berdasarkan status pekerjaan
            $paymentStatus = 'unpaid'; // Default untuk pending, ongoing, dan cancelled
            if ($orderStatus === 'completed') {
                // Jika pekerjaan selesai, ada kemungkinan sudah dibayar atau belum
                $paymentStatus = fake()->randomElement(['paid', 'unpaid']);
            }

            // --- AKHIR LOGIKA BARU ---

            Order::create([
                'user_id' => $customer->id,
                'tukang_id' => $tukang->id,
                'service_id' => $service->id,
                'location' => fake()->address(),
                'schedule' => fake()->dateTimeBetween('-1 month', '+1 month'),
                'problem_description' => 'Masalah pada ' . $service->name,
                'status' => $orderStatus, // Menggunakan variabel status pekerjaan
                'payment_status' => $paymentStatus, // Menggunakan variabel status pembayaran
                'total_price' => $service->pivot->price,
            ]);
        }
    }
}