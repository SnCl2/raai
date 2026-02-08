<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Bookings
        </a>
        <h1 class="text-2xl font-bold text-white">Booking Details #{{ $booking->id }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Client Details -->
        <div class="glass p-6 rounded-xl border border-white/10">
            <h2 class="text-lg font-semibold text-white mb-4">Client Information</h2>
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm text-gray-400">Name</dt>
                    <dd class="text-base text-white">{{ $booking->client_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-400">Email</dt>
                    <dd class="text-base text-white">{{ $booking->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-400">Phone</dt>
                    <dd class="text-base text-white">{{ $booking->phone ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-400">Business Name</dt>
                    <dd class="text-base text-white">{{ $booking->business_name ?? 'N/A' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Service & Payment Details -->
        <div class="glass p-6 rounded-xl border border-white/10">
            <h2 class="text-lg font-semibold text-white mb-4">Service & Payment</h2>
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm text-gray-400">Service</dt>
                    <dd class="text-base text-white">{{ $booking->service->title ?? 'Deleted Service' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-400">Price</dt>
                    <dd class="text-base text-white font-mono">${{ number_format($booking->amount, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-400">Payment Status</dt>
                    <dd class="mt-1">
                        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <select name="payment_status" class="bg-black/20 border border-gray-600 rounded text-sm text-white focus:outline-none focus:border-primary p-1">
                                <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                            <button type="submit" class="text-xs text-primary hover:text-white uppercase font-bold">Update</button>
                        </form>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-400">Payment ID (Razorpay)</dt>
                    <dd class="text-base text-white font-mono text-sm">{{ $booking->payment_id ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-400">Booking Date</dt>
                    <dd class="text-base text-white">{{ $booking->created_at->format('F d, Y h:i A') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Requirements -->
        <div class="glass p-6 rounded-xl border border-white/10 md:col-span-2">
            <h2 class="text-lg font-semibold text-white mb-4">Project Requirements</h2>
            <div class="bg-black/20 p-4 rounded-md text-gray-300 whitespace-pre-line border border-gray-700">
                {{ $booking->details ?? 'No additional details provided.' }}
            </div>
        </div>
    </div>
</x-admin-layout>
