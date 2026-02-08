<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.banners.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Banners
        </a>
        <h1 class="text-2xl font-bold text-white">Add New Banner</h1>
    </div>

    <div class="glass p-8 rounded-xl border border-white/10 max-w-2xl">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="headline" class="block text-sm font-medium text-gray-300">Headline</label>
                <input type="text" name="headline" id="headline" value="{{ old('headline') }}" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                @error('headline') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="subheadline" class="block text-sm font-medium text-gray-300">Subheadline</label>
                <input type="text" name="subheadline" id="subheadline" value="{{ old('subheadline') }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-300">Banner Image</label>
                <input type="file" name="image" id="image" required class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-indigo-700">
                @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="cta_text" class="block text-sm font-medium text-gray-300">CTA Text</label>
                    <input type="text" name="cta_text" id="cta_text" value="{{ old('cta_text') }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
                <div>
                    <label for="cta_link" class="block text-sm font-medium text-gray-300">CTA Link</label>
                    <input type="text" name="cta_link" id="cta_link" value="{{ old('cta_link') }}" placeholder="# or https://..." class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-300">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="mt-1 block w-24 bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                </div>
                <div class="flex items-center mt-6">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="h-4 w-4 text-primary focus:ring-primary border-gray-600 rounded bg-black/20">
                    <label for="is_active" class="ml-2 block text-sm text-gray-300">Active</label>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md transition-colors shadow-lg">
                    Create Banner
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
