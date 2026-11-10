<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category') ?? 'all';

        $posts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();
        $categories = Post::where('status', 'published')->distinct()->pluck('category')->filter();

        return view('pages.blog.index', compact('posts', 'categories', 'selectedCategory'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $recentPosts = Post::where('id', '!=', $post->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'recentPosts'));
    }
}
