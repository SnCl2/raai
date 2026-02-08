<x-admin-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stats Cards -->
        <div class="glass p-6 rounded-xl border border-white/10">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-400 text-sm font-medium">Total Bookings</h3>
                    <p class="text-3xl font-bold text-white mt-2">{{ $stats['total_bookings'] }}</p>
                </div>
                <div class="p-3 bg-blue-500/20 rounded-lg text-blue-400">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass p-6 rounded-xl border border-white/10">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-400 text-sm font-medium">Pending Payments</h3>
                    <p class="text-3xl font-bold text-white mt-2">{{ $stats['pending_bookings'] }}</p>
                </div>
                <div class="p-3 bg-yellow-500/20 rounded-lg text-yellow-400">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass p-6 rounded-xl border border-white/10">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-400 text-sm font-medium">Active Services</h3>
                    <p class="text-3xl font-bold text-white mt-2">{{ $stats['active_services'] }}</p>
                </div>
                <div class="p-3 bg-purple-500/20 rounded-lg text-purple-400">
                    <i class="fas fa-cubes text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass p-6 rounded-xl border border-white/10">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-400 text-sm font-medium">Portfolio Projects</h3>
                    <p class="text-3xl font-bold text-white mt-2">{{ $stats['projects'] }}</p>
                </div>
                <div class="p-3 bg-pink-500/20 rounded-lg text-pink-400">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="glass rounded-xl border border-white/10 overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-white">Recent Bookings</h2>
            <a href="{{ route('admin.bookings.index') }}" class="text-primary hover:text-white text-sm transition-colors">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-white/5">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($recent_bookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-white">{{ $booking->client_name }}</div>
                            <div class="text-sm text-gray-400">{{ $booking->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-300">{{ $booking->service->title ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-white font-mono">${{ number_format($booking->amount, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->payment_status === 'paid' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            {{ $booking->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.bookings.show', $booking) }}" class="text-primary hover:text-white transition-colors">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No recent bookings found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
