<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Order;

class RatingController extends Controller
{
    public function store(Request $request, Order $order)
    {
        // Keamanan: Pastikan yang memberi rating adalah pemilik pesanan
        // if ($order->user_id !== Auth::id()) {
        //     abort(403, 'Akses Ditolak.');
        // }

        // Validasi data yang masuk dari form
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:5000',
        ]);

        // Buat atau perbarui rating untuk pesanan ini
        Rating::updateOrCreate(
            [
                // Kunci untuk mencari record yang sudah ada
                'order_id' => $order->id,
                'user_id' => $order->user_id,
            ],
            [
                // Data untuk di-update atau dibuat
                'tukang_id' => $order->tukang_id,
                'rating' => $validated['rating'],    // <-- PERBAIKAN DI SINI (menggunakan 'rating')
                'comment' => $validated['comment'],  // <-- PERBAIKAN DI SINI (menggunakan 'comment')
            ]
        );

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Rating Anda berhasil disimpan!');
    }
}
