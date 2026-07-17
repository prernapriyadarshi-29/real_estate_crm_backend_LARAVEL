<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Get all leads for logged-in user (with pagination)
   public function index(Request $request)
{
    try {
        $search = $request->query('search', '');
        $status = $request->query('status', '');
        $perPage = $request->query('per_page', 10);

        $query = Lead::with('customer', 'property')  // ← ADD THIS
            ->where('user_id', auth()->id());

        // Filter by status (exact match)
        if ($status) {
            $query->where('status', $status);
        }

       // Search by customer name, phone, and note
if ($search) {
    $query->where(function($q) use ($search) {
        $q->whereHas('customer', function($customerQuery) use ($search) {
            $customerQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                          ->orWhereRaw('LOWER(phone) LIKE ?', ['%' . strtolower($search) . '%']);
        })
        ->orWhereRaw('LOWER(note) LIKE ?', ['%' . strtolower($search) . '%']);
    });
}

        // Paginate results
        $leads = $query->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'Leads retrieved successfully',
            'data' => $leads
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error retrieving leads',
            'errors' => ['error' => [$e->getMessage()]]
        ], 500);
    }
}

    // Create a new lead
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_id' => 'required|integer',
                'property_id' => 'required|integer',
                'status' => 'required|string|in:New,Contacted,Visited,Closed',
                'note' => 'nullable|string',
                'follow_up_date' => 'nullable|date'
            ]);

            $lead = Lead::create([
                'user_id' => auth()->id(),
                'customer_id' => $validated['customer_id'],
                'property_id' => $validated['property_id'],
                'status' => $validated['status'],
                'note' => $validated['note'] ?? null,
                'follow_up_date' => $validated['follow_up_date'] ?? null
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
                'status' => 'sometimes|string|in:New,Contacted,Visited,Closed',
                'note' => 'nullable|string',
                'follow_up_date' => 'nullable|date'
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
                'message' => 'Lead deleted successfully'
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