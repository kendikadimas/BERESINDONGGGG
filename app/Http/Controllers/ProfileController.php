<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user beserta riwayat pesanannya.
     */
    public function show(Request $request): InertiaResponse
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user();

        // 2. Ambil riwayat pesanan (sebagai customer) milik user tersebut
        // Gunakan .with() untuk eager loading agar query efisien
        $orders = $user->ordersAsCustomer()
            ->with([
                'worker:id,name', // Ambil hanya id dan nama dari relasi worker
                'service:id,name,service_category_id', // Ambil data dari relasi service
                'service.category:id,name' // Ambil data dari relasi category di dalam service
            ])
            ->latest() // Urutkan dari yang terbaru
            ->get();

        // 3. Render komponen Vue dan kirim data sebagai props
        return Inertia::render('ProfilePage', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }
}