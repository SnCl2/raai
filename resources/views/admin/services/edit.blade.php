<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Services
        </a>
        <h1 class="text-2xl font-bold text-white">Edit Service</h1>
    </div>

    <div class="glass p-8 rounded-xl border border-white/10 max-w-2xl">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300">Service Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-300">Price ($)</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $service->price) }}" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                @error('price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" rows="4" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">{{ old('description', $service->description) }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="features" class="block text-sm font-medium text-gray-300">Features (comma separated)</label>
                <input type="text" name="features" id="features" value="{{ old('features', implode(', ', (array)$service->features)) }}" placeholder="e.g. 2 revisions, HD Source File, 3 Concepts" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-300">Display Image</label>
                @if($service->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="Current Image" class="h-20 w-auto rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-indigo-700">
                <p class="text-xs text-gray-500 mt-1">Leave blank to keep current image</p>
                @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md transition-colors shadow-lg">
                    Update Service
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
