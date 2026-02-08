<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($validated['title']);
        $count = Project::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) $slug .= "-{$count}";

        $imagePath = $request->file('image')->store('projects', 'public');

        Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'image' => $imagePath,
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'description' => 'nullable|string',
        ]);

        if ($project->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $count = Project::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $project->id)->count();
            if ($count > 0) $slug .= "-{$count}";
            $project->slug = $slug;
        }

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->update([
            'title' => $validated['title'],
            'slug' => $project->slug, // Actually this should just stay unless regenerated
            'category' => $validated['category'],
            'image' => $project->image,
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
