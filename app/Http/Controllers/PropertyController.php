<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Get all properties for logged-in user (with pagination)
    public function index()
    {
        try {
            $properties = Property::where('user_id', auth()->id())
                                  ->paginate(10); // 10 properties per page
            
            return response()->json([
                'status' => true,
                'message' => 'Properties retrieved successfully',
                'data' => $properties
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve properties',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Create a new property
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:150',
                'price' => 'required|numeric|min:0',
                'city' => 'required|string|max:100',
                'address' => 'nullable|string',
                'bedrooms' => 'required|integer|min:0',
                'type' => 'required|string|max:50',
                'photo' => 'nullable|string',
                'status' => 'required|integer|in:0,1'
            ]);

            $property = Property::create([
                'user_id' => auth()->id(),
                ...$validated
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Property added successfully',
                'data' => $property
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
                'message' => 'Failed to create property',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Get single property
    public function show($id)
    {
        try {
            $property = Property::where('user_id', auth()->id())
                                ->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Property retrieved successfully',
                'data' => $property
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Property not found',
                'errors' => ['id' => ['Property does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve property',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Update property
    public function update(Request $request, $id)
    {
        try {
            $property = Property::where('user_id', auth()->id())
                                ->findOrFail($id);

            $validated = $request->validate([
                'title' => 'sometimes|string|max:150',
                'price' => 'sometimes|numeric|min:0',
                'city' => 'sometimes|string|max:100',
                'address' => 'nullable|string',
                'bedrooms' => 'sometimes|integer|min:0',
                'type' => 'sometimes|string|max:50',
                'photo' => 'nullable|string',
                'status' => 'sometimes|integer|in:0,1'
            ]);

            $property->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Property updated successfully',
                'data' => $property
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
                'message' => 'Property not found',
                'errors' => ['id' => ['Property does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update property',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Delete property
    public function destroy($id)
    {
        try {
            $property = Property::where('user_id', auth()->id())
                                ->findOrFail($id);

            $property->delete();

            return response()->json([
                'status' => true,
                'message' => 'Property deleted successfully',
                'data' => null
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Property not found',
                'errors' => ['id' => ['Property does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete property',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }
}