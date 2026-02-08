<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.testimonials.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Testimonials
        </a>
        <h1 class="text-2xl font-bold text-white">Edit Testimonial</h1>
    </div>

    <div class="glass p-8 rounded-xl border border-white/10 max-w-2xl">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="client_name" class="block text-sm font-medium text-gray-300">Client Name</label>
                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $testimonial->client_name) }}" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                @error('client_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="designation" class="block text-sm font-medium text-gray-300">Designation</label>
                <input type="text" name="designation" id="designation" value="{{ old('designation', $testimonial->designation) }}" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
            </div>

            <div>
                <label for="rating" class="block text-sm font-medium text-gray-300">Rating (1-5)</label>
                <select name="rating" id="rating" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    @for($i=1; $i<=5; $i++)
                        <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                    @endfor
                </select>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-300">Message</label>
                <textarea name="message" id="message" rows="4" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">{{ old('message', $testimonial->message) }}</textarea>
                @error('message') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-300">Client Photo</label>
                @if($testimonial->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Current Photo" class="h-20 w-auto rounded-full">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-indigo-700">
                <p class="text-xs text-gray-500 mt-1">Leave blank to keep current</p>
                @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md transition-colors shadow-lg">
                    Update Testimonial
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
