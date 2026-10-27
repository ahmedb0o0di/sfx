<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category');
        $query = Project::with(['category', 'images'])->orderBy('sort_order');

        if ($selectedCategory && $selectedCategory !== 'all') {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('filter_tag', $selectedCategory)->orWhere('slug', $selectedCategory);
            });
        }

        $projects = $query->get();
        $categories = ProjectCategory::orderBy('sort_order')->get();

        return view('pages.projects.index', compact('projects', 'categories', 'selectedCategory'));
    }

    public function show($slug)
    {
        $project = Project::with(['category', 'images'])->where('slug', $slug)->firstOrFail();
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('category_id', $project->category_id)
            ->take(3)
            ->get();

        return view('pages.projects.show', compact('project', 'relatedProjects'));
    }

    public function apiDetails($slug)
    {
        $project = Project::with(['category', 'images'])->where('slug', $slug)->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json([
            'id' => $project->slug,
            'title' => $project->title,
            'category' => $project->category ? $project->category->filter_tag : 'architectural',
            'categoryLabel' => $project->category ? $project->category->name : 'Architectural Structures',
            'location' => $project->location,
            'area' => $project->covered_area,
            'material' => $project->membrane_material,
            'year' => (string) $project->year_completed,
            'client' => $project->client_name,
            'span' => $project->engineering_solution,
            'image' => $project->thumbnail_image,
            'description' => $project->full_overview ?? $project->short_description,
            'gallery' => $project->images->pluck('image_path')->toArray(),
        ]);
    }
}
