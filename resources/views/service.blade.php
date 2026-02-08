<x-app-layout>
    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Service Info -->
                <div class="space-y-8 animate-fade-in-up">
                    <div>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-white mb-4 inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Home
                        </a>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $service->title }}</h1>
                        <div class="text-3xl font-bold text-primary mb-6">${{ number_format($service->price, 2) }}</div>
                        <p class="text-lg text-gray-300 leading-relaxed">
                            {{ $service->description }}
                        </p>
                    </div>

                    @if($service->features)
                    <div class="glass p-6 rounded-xl border border-white/10">
                        <h3 class="text-xl font-bold text-white mb-4">What's Included</h3>
                        <ul class="space-y-3">
                            @foreach($service->features as $feature)
                                <li class="flex items-start text-gray-300">
                                    <i class="fas fa-check-circle text-green-400 mt-1 mr-3"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    @if($service->image)
                        <div class="rounded-xl overflow-hidden shadow-2xl border border-white/5">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-auto">
                        </div>
                    @endif
                </div>

                <!-- Booking Form -->
                <div class="lg:sticky lg:top-24 animate-fade-in-up animation-delay-200">
                    <div class="glass p-8 rounded-2xl border border-white/10 shadow-2xl">
                        <h2 class="text-2xl font-bold text-white mb-6">Book This Service</h2>
                        <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            
                            <div>
                                <label for="client_name" class="block text-sm font-medium text-gray-300">Your Name</label>
                                <input type="text" name="client_name" id="client_name" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-lg shadow-sm py-3 px-4 text-white focus:outline-none focus:ring-primary focus:border-primary">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                                <input type="email" name="email" id="email" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-lg shadow-sm py-3 px-4 text-white focus:outline-none focus:ring-primary focus:border-primary">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-300">Phone</label>
                                    <input type="tel" name="phone" id="phone" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-lg shadow-sm py-3 px-4 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                </div>
                                <div>
                                    <label for="business_name" class="block text-sm font-medium text-gray-300">Business Name</label>
                                    <input type="text" name="business_name" id="business_name" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-lg shadow-sm py-3 px-4 text-white focus:outline-none focus:ring-primary focus:border-primary">
                                </div>
                            </div>

                            <div>
                                <label for="details" class="block text-sm font-medium text-gray-300">Project Details / Requirements</label>
                                <textarea name="details" id="details" rows="4" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-lg shadow-sm py-3 px-4 text-white focus:outline-none focus:ring-primary focus:border-primary" placeholder="Tell us about your vision..."></textarea>
                            </div>

                            <div class="pt-4 border-t border-white/10">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-gray-300">Total Payable</span>
                                    <span class="text-2xl font-bold text-white">${{ number_format($service->price, 2) }}</span>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-primary to-secondary text-white font-bold py-4 px-8 rounded-full shadow-lg hover:shadow-primary/50 transition transform hover:-translate-y-1">
                                    Proceed to Payment
                                </button>
                                <p class="text-center text-xs text-gray-500 mt-4">
                                    <i class="fas fa-lock mr-1"></i> Secure payment powered by Razorpay
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
