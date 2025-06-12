<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;
// Kita tidak lagi memerlukan Storage facade di sini

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Definisikan path URL publik ke gambar Anda.
        // PENTING: Pastikan Anda sudah membuat folder 'public/images/avatars'
        // dan menaruh file-file gambar ini di dalamnya.
        $tukangAvatars = [
            '/images/avatars/tukang1.png',
            '/images/avatars/tukang2.png',
            '/images/avatars/tukang3.png',
            '/images/avatars/tukang4.png',
            '/images/avatars/tukang5.png',
        ];

        // 2. Buat Admin Utama
        User::factory()->create([
            'name' => 'Admin Beresindong',
            'email' => 'admin@beresindong.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // 3. Buat 10 Customer menggunakan Factory
        User::factory()->count(10)->state(['role' => 'customer'])->create();

        // 4. Buat 10 Tukang dengan path foto yang sudah benar
        User::factory()->count(10)->state(['role' => 'tukang'])
            ->create()->each(function ($tukang) use ($tukangAvatars) {
                $tukang->skill = fake()->randomElement(['Pekerja Ahli', 'Pekerja Profesional', 'Pekerja Berkualitas', 'Spesialis Kelistrikan']);
                $tukang->rating = fake()->randomFloat(1, 4, 5);
                
                // Pilih satu path foto secara acak dan simpan ke database
                // Sekarang path yang disimpan sudah benar, misal: /images/avatars/tukang1.png
                $tukang->avatar_path = fake()->randomElement($tukangAvatars);
                
                $tukang->save();
        });
    }
}