<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyPhotoController extends Controller
{
    // Upload property photo
    public function upload(Request $request, $id)
    {
        try {
            // Find property
            $property = Property::where('user_id', auth()->id())
                                ->findOrFail($id);

            // Validate file
            $validated = $request->validate([
                'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048'
            ]);

            // Delete old photo if exists
            if ($property->photo) {
                Storage::disk('public')->delete($property->photo);
            }

            // Store new photo
            $photoPath = $request->file('photo')->store('properties', 'public');

            // Get full URL
            $photoUrl = asset('storage/' . $photoPath);

            // Update property with new photo path
            $property->update(['photo' => $photoPath]);

            return response()->json([
                'status' => true,
                'message' => 'Photo uploaded successfully',
                'photo_url' => $photoUrl
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
                'message' => 'Photo upload failed',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }
}