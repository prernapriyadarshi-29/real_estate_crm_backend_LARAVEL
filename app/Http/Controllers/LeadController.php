<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Get all leads for logged-in user (with pagination)
    public function index()
    {
        try {
            $leads = Lead::where('user_id', auth()->id())
                        ->paginate(10);
            
            return response()->json([
                'status' => true,
                'message' => 'Leads retrieved successfully',
                'data' => $leads
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve leads',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Create a new lead
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'required|string|max:20',
                'city' => 'required|string|max:100',
                'status' => 'required|string|max:50',
                'notes' => 'nullable|string'
            ]);

            $lead = Lead::create([
                'user_id' => auth()->id(),
                ...$validated
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Lead added successfully',
                'data' => $lead
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create lead',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Get single lead
    public function show($id)
    {
        try {
            $lead = Lead::where('user_id', auth()->id())
                        ->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Lead retrieved successfully',
                'data' => $lead
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lead not found',
                'errors' => ['id' => ['Lead does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve lead',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Update lead
    public function update(Request $request, $id)
    {
        try {
            $lead = Lead::where('user_id', auth()->id())
                        ->findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:100',
                'email' => 'sometimes|email|max:100',
                'phone' => 'sometimes|string|max:20',
                'city' => 'sometimes|string|max:100',
                'status' => 'sometimes|string|max:50',
                'notes' => 'nullable|string'
            ]);

            $lead->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Lead updated successfully',
                'data' => $lead
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lead not found',
                'errors' => ['id' => ['Lead does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update lead',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Delete lead
    public function destroy($id)
    {
        try {
            $lead = Lead::where('user_id', auth()->id())
                        ->findOrFail($id);

            $lead->delete();

            return response()->json([
                'status' => true,
                'message' => 'Lead deleted successfully',
                'data' => null
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lead not found',
                'errors' => ['id' => ['Lead does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete lead',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }
}