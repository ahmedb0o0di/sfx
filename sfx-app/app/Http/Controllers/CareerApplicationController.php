<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    /**
     * Store a candidate career application with CV and response.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'career_id' => 'nullable|exists:careers,id',
            'job_title' => 'required|string|max:200',
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:60',
            'portfolio_url' => 'nullable|url|max:255',
            'cover_letter' => 'required|string|max:5000',
            'cv' => 'required|file|mimes:pdf,doc,docx,zip|max:20480',
        ], [
            'job_title.required' => 'The job title is required.',
            'name.required' => 'Please provide your full name.',
            'email.required' => 'A valid corporate or personal email address is required.',
            'phone.required' => 'Please enter your phone number.',
            'cover_letter.required' => 'Please provide a brief cover note or description of your experience.',
            'cv.required' => 'Please upload your CV / Resume (PDF, DOC, DOCX).',
            'cv.mimes' => 'The CV must be a file of type: PDF, DOC, DOCX, or ZIP.',
            'cv.max' => 'The CV may not be greater than 20MB.',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        // Auto-resolve job_title from Career model if provided
        $jobTitle = $validated['job_title'];
        if (!empty($validated['career_id'])) {
            $career = Career::find($validated['career_id']);
            if ($career) {
                $jobTitle = $career->title;
            }
        }

        $application = CareerApplication::create([
            'career_id' => $validated['career_id'] ?? null,
            'job_title' => $jobTitle,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'portfolio_url' => $validated['portfolio_url'] ?? null,
            'cover_letter' => $validated['cover_letter'],
            'cv_path' => $cvPath,
            'status' => 'pending',
        ]);

        $successMsg = 'Your application for "' . $jobTitle . '" has been submitted successfully. Our engineering recruitment desk will review your credentials.';

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'application_id' => $application->id,
            ]);
        }

        return back()->with('career_success', $successMsg);
    }
}
