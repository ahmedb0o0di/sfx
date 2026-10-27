<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display listing of career opportunities.
     */
    public function index()
    {
        $careers = Career::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.careers', compact('careers'));
    }

    /**
     * Display a specific career details page with embedded apply CV form.
     */
    public function show(string $slug)
    {
        $career = Career::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $otherCareers = Career::where('is_active', true)
            ->where('id', '!=', $career->id)
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();

        return view('pages.career-detail', compact('career', 'otherCareers'));
    }
}
