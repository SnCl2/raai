<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="glass max-w-lg w-full p-10 rounded-2xl border border-white/10 text-center">
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-500/20 mb-8 animate-bounce">
                <i class="fas fa-check text-green-400 text-4xl"></i>
            </div>
            
            <h1 class="text-4xl font-bold text-white mb-4">Payment Successful!</h1>
            <p class="text-xl text-gray-300 mb-8">
                Thank you, <span class="text-primary font-semibold">{{ $booking->client_name }}</span>. Your booking has been confirmed.
            </p>
            
            <div class="bg-white/5 p-6 rounded-xl text-left space-y-4 mb-8">
                <div class="flex justify-between text-gray-300">
                    <span>Booking ID:</span>
                    <span class="font-mono text-white">#{{ $booking->id }}</span>
                </div>
                <div class="flex justify-between text-gray-300">
                    <span>Service:</span>
                    <span class="font-medium text-white">{{ $booking->service->title }}</span>
                </div>
                <div class="flex justify-between text-gray-300">
                    <span>Amount Paid:</span>
                    <span class="font-bold text-white">${{ number_format($booking->amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-gray-300">
                    <span>Transaction ID:</span>
                    <span class="font-mono text-xs text-white">{{ $booking->payment_id }}</span>
                </div>
            </div>

            <p class="text-gray-400 mb-8">
                We have sent a confirmation email to <span class="text-white">{{ $booking->email }}</span>. We will be in touch shortly to discuss your project.
            </p>

            <a href="{{ route('home') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-primary to-secondary text-white font-bold rounded-full hover:shadow-lg transition transform hover:-translate-y-1">
                Back to Home
            </a>
        </div>
    </div>
</x-app-layout>
