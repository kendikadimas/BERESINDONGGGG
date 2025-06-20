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
    public function show(Request $request)
    {
        $user = Auth::user();

        // Modifikasi query untuk memuat relasi 'rating'
        $orders = $user->ordersAsCustomer()
            ->with([
                'worker:id,name',
                'service.category:id,name',
                'rating', // <-- TAMBAHKAN INI
            ])
            ->latest()
            ->get();

        return Inertia::render('ProfilePage', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }
}