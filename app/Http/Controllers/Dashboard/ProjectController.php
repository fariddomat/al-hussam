<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $projects = Project::all();
        return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
        $projectCategories = \App\Models\ProjectCategory::all();
        return view('dashboard.projects.create', compact('projectCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'date_of_build' => 'required|date',
            'address' => 'required|string',
            'address_location' => 'nullable|string',
            'virtual_location' => 'nullable|string',
            'scheme_name' => 'required|string|max:255',
            'floors_count' => 'required|numeric',
            'details' => 'required|string',
            'img' => 'required|image|max:2048',
            'cover_img' => 'nullable|image|max:2048',
            'show_home' => 'boolean', // Added show_home validation
            'status' => 'required', // Updated to match ENUM
            'status_percent' => 'required|numeric|min:0|max:100',
            'project_category_id' => 'required|exists:project_categories,id',
            'sort_id' => 'nullable|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }
        if ($request->hasFile('cover_img')) {
            $validated['cover_img'] = $request->file('cover_img')->store('public/cover_imgs');
        }
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public/logos');
        }
        if ($request->hasFile('images')) {
            $validated['images'] = array_map(fn($file) => $file->store('public/images'), $request->file('images'));
        }

        $project = Project::create($validated);

        return redirect()->route('dashboard.projects.index')->with('success', 'Project created successfully.');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('dashboard.projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $projectCategories = \App\Models\ProjectCategory::all();
        return view('dashboard.projects.edit', compact('project', 'projectCategories'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'date_of_build' => 'required|date',
            'address' => 'required|string',
            'address_location' => 'nullable|string',
            'virtual_location' => 'nullable|string',
            'scheme_name' => 'required|string|max:255',
            'floors_count' => 'required|numeric',
            'details' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'cover_img' => 'nullable|image|max:2048',
            'show_home' => 'boolean', // Added show_home validation
            'status' => 'required', // Updated to match ENUM
            'status_percent' => 'required|numeric|min:0|max:100',
            'project_category_id' => 'required|exists:project_categories,id',
            'sort_id' => 'nullable|numeric',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048'
        ]);

        if ($request->hasFile('img')) {
            if ($project->img) {
                Storage::delete($project->img);
            }
            $validated['img'] = $request->file('img')->store('public/imgs');
        }
        if ($request->hasFile('cover_img')) {
            if ($project->cover_img) {
                Storage::delete($project->cover_img);
            }
            $validated['cover_img'] = $request->file('cover_img')->store('public/cover_imgs');
        }
        if ($request->hasFile('logo')) {
            if ($project->logo) {
                Storage::delete($project->logo);
            }
            $validated['logo'] = $request->file('logo')->store('public/logos');
        }
        if ($request->hasFile('images')) {
            if ($project->images) {
                foreach ($project->images as $image) {
                    Storage::delete($image);
                }
            }
            $validated['images'] = array_map(fn($file) => $file->store('public/images'), $request->file('images'));
        }

        if(!$request->show_home){
            $validated['show_home'] =0;
        }
        $project->update($validated);

        return redirect()->route('dashboard.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('dashboard.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();
        return redirect()->route('dashboard.projects.index')->with('success', 'Project restored successfully.');
    }
}
