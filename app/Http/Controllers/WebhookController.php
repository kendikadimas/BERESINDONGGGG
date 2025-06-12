<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;
use Exception;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Midtrans Webhook Received:', $request->all());

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');

        try {
            // Library ini akan membaca input dan memvalidasi signature secara internal
            $notification = new Notification();
        
            $transactionStatus = $notification->transaction_status;
            $orderId = explode('-', $notification->order_id)[0];
            
            Log::info('Extracted Order ID to find:', ['extracted_id' => $orderId]);
            
            $order = Order::find($orderId);

            if (!$order) {
                Log::warning('Order with extracted ID not found in database.', ['searched_id' => $orderId]);
                return response()->json(['message' => 'Order not found.'], 404);
            }

            if ($order->payment_status === 'paid') {
                return response()->json(['message' => 'Payment already processed.']);
            }
            
            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                $order->payment_status = 'paid';
            } 
            else if ($transactionStatus == 'expire' || $transactionStatus == 'cancel' || $transactionStatus == 'deny') {
                $order->payment_status = 'failed';
            }
            
            $order->save();
            
            Log::info('Order status updated successfully.', ['order_id' => $orderId, 'new_status' => $order->payment_status]);
            return response()->json(['message' => 'Notification handled successfully.']);

        } catch (Exception $e) {
            Log::error('Webhook Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Webhook Error: ' . $e->getMessage()], 500);
        }
    }
}