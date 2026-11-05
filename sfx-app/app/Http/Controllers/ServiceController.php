<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('pages.services.index', compact('services'));
    }

    public function show($slug)
    {
        // Support alias slugs from option-1
        if (in_array($slug, ['asati-dome', 'air-supported', 'air-supported-multisport-dome'])) {
            return redirect()->route('services.show', 'air-supported-domes');
        }
        if (in_array($slug, ['sol-lifecycle', 'lifecycle', 'amc', 'inspection-amc'])) {
            return redirect()->route('services.show', 'lifecycle-maintenance');
        }

        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedProjects = Project::take(3)->get();
        return view('pages.services.show', compact('service', 'relatedProjects'));
    }
}
