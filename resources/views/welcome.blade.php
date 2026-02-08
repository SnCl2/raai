<x-app-layout>
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- Particles container handled by layout -->
        </div>
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
            @if($banners->count() > 0)
                <div x-data="{ activeSlide: 0, slides: {{ $banners->count() }} }" x-init="setInterval(() => { activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1 }, 5000)" class="relative">
                    @foreach($banners as $index => $banner)
                        <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-105" class="absolute inset-0 flex flex-col items-center justify-center -mt-20">
                            <!-- Image Background for Banner (Optional, currently using particles as main bg) -->
                            <!-- If banner has image, maybe display it? For now, text only overlay on particles -->
                            <h1 class="text-5xl md:text-7xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary mb-6 animate-fade-in-up">
                                {{ $banner->headline }}
                            </h1>
                            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
                                {{ $banner->subheadline }}
                            </p>
                            <a href="{{ $banner->cta_link ?? '#services' }}" class="px-8 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-full font-bold text-lg hover:shadow-lg hover:shadow-primary/50 transition transform hover:-translate-y-1 animate-fade-in-up animation-delay-400">
                                {{ $banner->cta_text ?? 'Get Started' }}
                            </a>
                        </div>
                    @endforeach
                     <!-- Placeholder height for absolute positioning -->
                    <div class="invisible flex flex-col items-center justify-center">
                        <h1 class="text-5xl md:text-7xl font-extrabold mb-6">Placeholder</h1>
                        <p class="text-xl md:text-2xl mb-8">Placeholder</p>
                        <a href="#" class="px-8 py-3">Btn</a>
                    </div>
                </div>
            @else
                <h1 class="text-5xl md:text-7xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary mb-6 animate-fade-in-up">
                    {{ $settings['site_title'] ?? 'Raai Logo Design' }}
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
                    {{ $settings['seo_description'] ?? 'Crafting unique brand identities that speak volumes.' }}
                </p>
                <a href="#services" class="px-8 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-full font-bold text-lg hover:shadow-lg hover:shadow-primary/50 transition transform hover:-translate-y-1 animate-fade-in-up animation-delay-400">
                    View Our Services
                </a>
            @endif
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Our Premium Services</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="glass p-8 rounded-2xl hover:bg-white/5 transition duration-300 transform hover:-translate-y-2 group border border-white/5">
                    <div class="h-48 w-full mb-6 rounded-lg overflow-hidden relative">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                <i class="fas fa-paint-brush text-4xl text-gray-600"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <a href="{{ route('service.show', $service->slug) }}" class="px-6 py-2 bg-white text-dark font-bold rounded-full transform scale-90 group-hover:scale-100 transition duration-300">View Details</a>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ $service->title }}</h3>
                    <p class="text-gray-400 mb-4 line-clamp-3">{{ $service->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-primary">${{ number_format($service->price, 0) }}</span>
                        <a href="{{ route('service.show', $service->slug) }}" class="text-white hover:text-primary transition font-medium flex items-center">
                            Book Now <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-black/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Featured Work</h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
                </div>
                <!-- Filter buttons could go here -->
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                <div class="group relative rounded-xl overflow-hidden aspect-[4/3] glass border border-white/5">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                        <span class="text-primary text-sm font-semibold tracking-wider uppercase mb-1">{{ $project->category }}</span>
                        <h3 class="text-white text-xl font-bold">{{ $project->title }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Client Success Stories</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="glass p-8 rounded-2xl border border-white/10 relative">
                    <div class="absolute -top-4 -left-4 text-6xl text-primary/20 font-serif">"</div>
                    <div class="flex items-center mb-6">
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->client_name }}" class="w-12 h-12 rounded-full object-cover mr-4">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold text-lg mr-4">
                                {{ substr($testimonial->client_name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h4 class="text-white font-bold">{{ $testimonial->client_name }}</h4>
                            <p class="text-gray-400 text-sm">{{ $testimonial->designation }}</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4 relative z-10">{{ $testimonial->message }}</p>
                    <div class="flex text-yellow-500 text-sm">
                        @for($i=0; $i<$testimonial->rating; $i++) <i class="fas fa-star"></i> @endfor
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section id="contact" class="py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass rounded-3xl p-12 text-center border border-white/10 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/20 rounded-full blur-3xl -ml-32 -mb-32"></div>
                
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 relative z-10">Ready to Elevate Your Brand?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto relative z-10">
                    Let's create a visual identity that resonates with your audience and stands the test of time.
                </p>
                <div class="flex justify-center gap-4 relative z-10">
                    <a href="#services" class="px-8 py-3 bg-white text-dark rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-lg">Start a Project</a>
                    @if(isset($settings['contact_email']))
                        <a href="mailto:{{ $settings['contact_email'] }}" class="px-8 py-3 glass border border-white/20 text-white rounded-full font-bold text-lg hover:bg-white/10 transition">Contact Us</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
