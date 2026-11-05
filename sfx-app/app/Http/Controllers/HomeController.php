<?php

namespace App\Http\Controllers;

use App\Models\Career;
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
            ->take(8)
            ->get();

        $allProjects = Project::with('category')
            ->orderBy('sort_order')
            ->take(18)
            ->get();

        $categories = ProjectCategory::orderBy('sort_order')->get();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $latestPosts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        $careers = Career::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.home', compact(
            'featuredProjects',
            'allProjects',
            'categories',
            'services',
            'latestPosts',
            'careers'
        ));
    }
}
