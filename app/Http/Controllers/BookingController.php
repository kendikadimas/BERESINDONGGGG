<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Exception;
use Midtrans\Snap;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking dengan data layanan dan tukang yang sudah dipilih.
     * Metode ini menggunakan Route Model Binding untuk secara otomatis mengambil
     * record Service dan User (tukang) dari database berdasarkan ID di URL.
     *
     * @param \App\Models\Service $service
     * @param \App\Models\User $tukang
     * @return \Inertia\Response
     */
    public function create(Service $service, User $tukang): InertiaResponse
    {
        // Keamanan: Pastikan user yang dipilih adalah benar-benar seorang tukang.
        if ($tukang->role !== 'tukang') {
            abort(404, 'Penyedia jasa tidak ditemukan.');
        }

        // Ambil data penawaran spesifik dari tabel pivot untuk mendapatkan harga
        $offering = $tukang->offeredServices()->where('service_id', $service->id)->first();

        // Jika karena suatu hal penawarannya tidak ada (misal: URL diakses manual)
        if (!$offering) {
            abort(404, 'Tukang ini tidak menawarkan layanan yang dipilih.');
        }

        // Ambil harga yang ditetapkan oleh tukang dari data pivot
        $price = $offering->pivot->price;

        // Render halaman BookingForm, kirim data yang dibutuhkan sebagai props
        return Inertia::render('BookingForm', [
            'selectedService' => $service->only('id', 'name'),
            'selectedTukang' => $tukang->only('id', 'name'),
            'offeringPrice' => (float) $price,
        ]);
    }

    /**
     * Memvalidasi dan menyimpan pesanan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validasi data form
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'tukang_id' => 'required|exists:users,id',
            'schedule_date' => 'required|date|after_or_equal:today',
            'schedule_time' => 'required',
            'problem_description' => 'required|string|min:10',
            'location' => 'required|string|min:10',
            'total_price' => 'required|numeric',
        ]);

        // 2. Buat pesanan baru di database
        $order = Order::create([
            'user_id' => Auth::id(),
            'tukang_id' => $validated['tukang_id'],
            'service_id' => $validated['service_id'],
            'schedule' => $validated['schedule_date'] . ' ' . $validated['schedule_time'],
            'problem_description' => $validated['problem_description'],
            'location' => $validated['location'],
            'total_price' => $validated['total_price'],
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // 3. Langsung generate Snap Token untuk pesanan yang baru dibuat
        try {
            $params = [
                'transaction_details' => [
                    'order_id' => $order->id . '-' . time(),
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->customer->name,
                    'email' => $order->customer->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->snap_token = $snapToken;
            $order->save();

            // 4. Redirect kembali dengan MEMBAWA snap_token di flash session
            return back()->with('snap_token', $snapToken);

        } catch (Exception $e) {
            // Jika gagal membuat token, kembali dengan pesan error
            return back()->withErrors(['midtrans_error' => 'Gagal memulai sesi pembayaran: ' . $e->getMessage()]);
        }
    }
}