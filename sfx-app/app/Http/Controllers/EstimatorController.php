<?php

namespace App\Http\Controllers;

use App\Models\EstimatorLead;
use Illuminate\Http\Request;

class EstimatorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'structure_type' => 'required|string|max:100',
            'footprint_area' => 'required|numeric|min:50|max:100000',
            'membrane_choice' => 'required|string|max:50',
            'calculated_tonnage' => 'nullable|numeric',
            'estimated_weeks' => 'nullable|string|max:50',
            'client_name' => 'required|string|max:100',
            'client_email' => 'required|email|max:150',
            'client_phone' => 'required|string|max:50',
            'company_name' => 'nullable|string|max:150',
            'project_location' => 'nullable|string|max:150',
            'additional_notes' => 'nullable|string|max:2000',
        ]);

        $lead = EstimatorLead::create([
            'structure_type' => $validated['structure_type'],
            'footprint_area' => $validated['footprint_area'],
            'membrane_choice' => $validated['membrane_choice'],
            'calculated_tonnage' => $validated['calculated_tonnage'] ?? null,
            'estimated_weeks' => $validated['estimated_weeks'] ?? null,
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'company_name' => $validated['company_name'] ?? null,
            'project_location' => $validated['project_location'] ?? null,
            'additional_notes' => $validated['additional_notes'] ?? null,
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your scope specification and RFP inquiry have been recorded.',
            'reference_id' => 'RFP-' . str_pad($lead->id, 5, '0', STR_PAD_LEFT),
            'lead' => $lead,
        ]);
    }
}
