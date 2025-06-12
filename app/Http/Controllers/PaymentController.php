<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function createTransaction(Request $request, Order $order): RedirectResponse
    {
        // Keamanan: Pastikan hanya pemilik order yang bisa memulai pembayaran.
        if ($order->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK.');
        }

        try {
            // Panggil metode privat untuk mendapatkan snap token
            $snapToken = $this->_generateSnapToken($order);

            // Redirect kembali ke halaman sebelumnya dengan snap token di flash session.
            return back()->with('snap_token', $snapToken);

        } catch (Exception $e) {
            // Jika ada error dari Midtrans atau lainnya, kembali dengan pesan error
            return back()->withErrors(['error' => 'Gagal membuat sesi pembayaran: ' . $e->getMessage()]);
        }
    }


    public function showCheckoutPage(Request $request, Order $order): View
    {
        try {
            $snapToken = $this->_generateSnapToken($order);
            return view('checkout', compact('snapToken'));
        } catch (Exception $e) {
            abort(500, 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    private function _generateSnapToken(Order $order): string
    {
        if ($order->snap_token) {
            return $order->snap_token;
        }

        $params = [
            'transaction_details' => ['order_id' => $order->id . '-' . time(), 'gross_amount' => $order->total_price],
            'customer_details' => ['first_name' => $order->customer->name, 'email' => $order->customer->email],
        ];

        $snapToken = Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();
        return $snapToken;
    }
}