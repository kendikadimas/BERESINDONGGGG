<?php
// app/Http/Controllers/LandingPageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Testimonial;
use App\Models\User; // Impor model User untuk mengambil data tukang

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman utama (landing page) dengan data yang diperlukan.
     */
    public function index()
    {
        // Mengambil 4 testimoni terbaru yang sudah disetujui, beserta data user-nya
        $testimonials = Testimonial::where('is_approved', true)
            ->with('user:id,name,avatar_path') // Mengambil hanya kolom yg perlu dari relasi user
            ->latest()
            ->take(4) // Ambil 4 testimoni saja
            ->get();
        
        // Contoh: Mengambil 5 tukang dengan rating tertinggi untuk ditampilkan
        $featuredWorkers = User::where('role', 'tukang')
            ->orderBy('rating', 'desc')
            ->limit(5)
            ->get();

        // Kirim semua data ke komponen Vue 'LandingPage'
        return Inertia::render('LandingPage', [
            'testimonials' => $testimonials,
            'featuredWorkers' => $featuredWorkers,
        ]);
    }
}