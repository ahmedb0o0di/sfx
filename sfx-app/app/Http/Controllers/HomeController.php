<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::with('category')
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $allProjects = Project::with('category')
            ->orderBy('sort_order')
            ->take(12)
            ->get();

        $categories = ProjectCategory::orderBy('sort_order')->get();
        $services = Service::orderBy('sort_order')->get();
        $materials = Material::orderBy('sort_order')->get();
        $latestPosts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.home', compact(
            'featuredProjects',
            'allProjects',
            'categories',
            'services',
            'materials',
            'latestPosts'
        ));
    }
}
