<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="glass max-w-md w-full p-8 rounded-2xl border border-white/10 text-center space-y-8">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                <i class="fas fa-lock text-green-600 text-2xl"></i>
            </div>
            
            <h2 class="text-3xl font-extrabold text-white">Complete Your Payment</h2>
            
            <div class="bg-white/5 p-6 rounded-lg text-left space-y-3">
                <div class="flex justify-between text-gray-300">
                    <span>Service:</span>
                    <span class="font-medium text-white">{{ $booking->service->title }}</span>
                </div>
                <div class="flex justify-between text-gray-300">
                    <span>Amount:</span>
                    <span class="font-bold text-white text-xl">${{ number_format($booking->amount, 2) }}</span>
                </div>
            </div>

            <p class="text-gray-400 text-sm">
                You will be redirected to our secure payment gateway to finalize your booking.
            </p>

            <button id="rzp-button1" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-green-500/50 transition transform hover:-translate-y-1">
                Pay Securely Now
            </button>
            
            <!-- Standard Razorpay Checkout Form -->
            <form id="razorpay-form" action="{{ route('booking.callback') }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                <input type="hidden" name="razorpay_signature" id="razorpay_signature">
            </form>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ $keyId }}",
            "amount": "{{ $booking->amount * 100 }}", 
            "currency": "USD",
            "name": "{{ config('app.name', 'Raai Logo Design') }}",
            "description": "Payment for Booking #{{ $booking->id }}",
            "image": "https://example.com/logo.png", // Replace with actual logo URL
            "order_id": "{{ $orderId }}", 
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpay-form').submit();
            },
            "prefill": {
                "name": "{{ $booking->client_name }}",
                "email": "{{ $booking->email }}",
                "contact": "{{ $booking->phone }}"
            },
            "theme": {
                "color": "#6366f1"
            }
        };
        var rzp1 = new Razorpay(options);
        
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
        
        // Auto-click on load for smoother experience?
        // window.onload = function() { rzp1.open(); };
    </script>
</x-app-layout>
