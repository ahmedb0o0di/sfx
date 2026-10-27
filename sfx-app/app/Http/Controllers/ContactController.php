<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:5000',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,dwg,dxf,zip,jpg,png|max:15360',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('inquiries', 'public');
        }

        $inquiry = ContactInquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'attachment_path' => $attachmentPath,
            'status' => 'pending',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you. Your inquiry has been dispatched to our engineering team.',
                'reference_id' => 'SFX-' . str_pad($inquiry->id, 5, '0', STR_PAD_LEFT),
            ]);
        }

        return back()->with('success', 'Your inquiry has been received. Our regional team will contact you within 24 hours.');
    }
}
