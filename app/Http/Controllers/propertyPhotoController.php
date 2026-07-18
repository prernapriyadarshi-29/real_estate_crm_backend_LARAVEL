<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyPhotoController extends Controller
{
    public function upload(Request $request, $propertyId)
    {
        try {
            $property = Property::findOrFail($propertyId);
            if ($property->user_id != auth()->id()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                    ], 403);
                    }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = $file->store('properties', 'public');
                
                // Save to database
                $property->photo = $filename;
                $property->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Photo uploaded successfully',
                    'photo_url' => $filename
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'No photo provided'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Upload failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}