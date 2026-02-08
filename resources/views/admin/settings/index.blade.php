<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Site Settings</h1>
    </div>

    <div class="glass p-8 rounded-xl border border-white/10 max-w-4xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Payment Settings -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4 border-b border-white/10 pb-2">Payment Integration (Razorpay)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="razorpay_key" class="block text-sm font-medium text-gray-300">Razorpay Key ID</label>
                        <input type="text" name="razorpay_key" id="razorpay_key" value="{{ $settings['razorpay_key'] ?? '' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div>
                        <label for="razorpay_secret" class="block text-sm font-medium text-gray-300">Razorpay Secret</label>
                        <input type="password" name="razorpay_secret" id="razorpay_secret" value="{{ $settings['razorpay_secret'] ?? '' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>
            </div>

            <!-- General Settings -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4 border-b border-white/10 pb-2">General Information</h3>
                <div class="space-y-4">
                    <div>
                        <label for="site_title" class="block text-sm font-medium text-gray-300">Site Title</label>
                        <input type="text" name="site_title" id="site_title" value="{{ $settings['site_title'] ?? 'Raai Logo Design' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div>
                        <label for="seo_description" class="block text-sm font-medium text-gray-300">SEO Meta Description</label>
                        <textarea name="seo_description" id="seo_description" rows="3" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">{{ $settings['seo_description'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-300">Contact Email</label>
                        <input type="email" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-300">Contact Phone</label>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4 border-b border-white/10 pb-2">Social Media Links</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="twitter_link" class="block text-sm font-medium text-gray-300">Twitter URL</label>
                        <input type="url" name="twitter_link" id="twitter_link" value="{{ $settings['twitter_link'] ?? '' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div>
                        <label for="instagram_link" class="block text-sm font-medium text-gray-300">Instagram URL</label>
                        <input type="url" name="instagram_link" id="instagram_link" value="{{ $settings['instagram_link'] ?? '' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                    <div>
                        <label for="linkedin_link" class="block text-sm font-medium text-gray-300">LinkedIn URL</label>
                        <input type="url" name="linkedin_link" id="linkedin_link" value="{{ $settings['linkedin_link'] ?? '' }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-white/10">
                <button type="submit" class="w-full md:w-auto bg-primary hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-md transition-colors shadow-lg">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
