<x-admin-layout>
    <div class="mb-6">
        <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Projects
        </a>
        <h1 class="text-2xl font-bold text-white">Edit Project</h1>
    </div>

    <div class="glass p-8 rounded-xl border border-white/10 max-w-2xl">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300">Project Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-300">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category', $project->category) }}" placeholder="e.g. Logo Design, Branding" required class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                @error('category') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full bg-black/20 border border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">{{ old('description', $project->description) }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-300">Project Image</label>
                @if($project->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Current Project" class="h-20 w-auto rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-indigo-700">
                <p class="text-xs text-gray-500 mt-1">Leave blank to keep current</p>
                @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md transition-colors shadow-lg">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
