<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Setting;
use Razorpay\Api\Api;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'business_name' => 'nullable|string|max:255',
            'details' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);
        
        $booking = Booking::create([
            'service_id' => $service->id,
            'client_name' => $request->client_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'business_name' => $request->business_name,
            'details' => $request->details,
            'amount' => $service->price,
            'payment_status' => 'pending',
        ]);

        // Razorpay Integration
        $keyId = Setting::where('key', 'razorpay_key')->value('value');
        $keySecret = Setting::where('key', 'razorpay_secret')->value('value');

        if (!$keyId || !$keySecret) {
            // Fallback for demo or if keys not set
            return redirect()->route('home')->with('error', 'Payment gateway not configured.');
        }

        $api = new Api($keyId, $keySecret);
        
        $orderData = [
            'receipt'         => (string) $booking->id,
            'amount'          => (int) ($booking->amount * 100), // Amount in subunits (paise/cents)
            'currency'        => 'USD', // Default to USD or change to INR based on preference
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);
            $orderId = $razorpayOrder['id'];
        } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Error creating payment order: ' . $e->getMessage());
        }

        return view('booking.payment', compact('booking', 'orderId', 'keyId'));
    }

    public function callback(Request $request)
    {
        $input = $request->all();

        $keyId = Setting::where('key', 'razorpay_key')->value('value');
        $keySecret = Setting::where('key', 'razorpay_secret')->value('value');
        
        $api = new Api($keyId, $keySecret);

        $success = false;

        if (!empty($input['razorpay_payment_id'])) {
            try {
                $attributes = array(
                    'razorpay_order_id' => $input['razorpay_order_id'],
                    'razorpay_payment_id' => $input['razorpay_payment_id'],
                    'razorpay_signature' => $input['razorpay_signature']
                );

                $api->utility->verifyPaymentSignature($attributes);
                $success = true;
            } catch (\Exception $e) {
                $success = false;
            }
        }

        if ($success) {
            // Find booking by Razorpay Order ID (need to store it or look it up? Actually prompt pass booking_id in notes or callback URL?)
            // We didn't store razorpay_order_id in booking table.
            
            // Standard approach: The callback is a POST to this route. We can pass the booking ID in the redirect URL or rely on session.
            // But verifySignature relies on inputs.
            
            // Let's rely on finding standard way -> OrderID mapping usually done in DB.
            // But since I didn't add order_id column, I can't easily lookup.
            // Wait, I can pass it in the payment page as a hidden field but the callback comes from Razorpay?
            // Razorpay Standard Checkout posts back to the `callback_url`.
            // We can't easily pass custom params unless we append to URL.
            
            // Wait, the POST request from Checkout contains specific fields.
            // If I want to know WHICH booking, I should have stored the order_id.
            
            // Quick fix: Add `razorpay_order_id` to bookings table? Or just assume session?
            // Session is risky if user opens multiple tabs.
            // Let's add `razorpay_order_id` to `bookings` table via migration?
            // Or use the `notes` field in Razorpay order to store booking_id and fetch order details?
            // But verifySignature doesn't return the order details, it just verifies.
            
            // Better approach without migration:
            // Use metadata/notes in Razorpay order creation.
            // In callback, fetch the order from API using `razorpay_order_id` to get the notes -> booking_id.
            
            try {
                // Fetch order to get notes (booking_id)
                $order = $api->order->fetch($input['razorpay_order_id']);
                $bookingId = $order['receipt']; // We used booking ID as receipt
                
                $booking = Booking::findOrFail($bookingId);
                $booking->update([
                    'payment_status' => 'paid',
                    'payment_id' => $input['razorpay_payment_id'],
                ]);
                
                return view('booking.success', compact('booking'));
                
            } catch (\Exception $e) {
                return redirect()->route('home')->with('error', 'Payment verification failed: ' . $e->getMessage());
            }

        } else {
            return redirect()->route('home')->with('error', 'Payment verification failed.');
        }
    }
}
