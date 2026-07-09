<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Get logged-in user's profile
    public function show()
    {
        try {
            $profile = Profile::where('user_id', auth()->id())->first();

            if (!$profile) {
                return response()->json([
                    'status' => false,
                    'message' => 'Profile not found',
                    'errors' => ['profile' => ['User profile does not exist']]
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Profile retrieved successfully',
                'data' => $profile
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve profile',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Create or Update profile
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'bio' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'pincode' => 'nullable|string|max:10',
                'specialization' => 'nullable|string|max:100',
                'experience' => 'nullable|string|max:50',
                'photo' => 'nullable|string',
                'website' => 'nullable|string|max:255'
            ]);

            $profile = Profile::where('user_id', auth()->id())->first();

            if (!$profile) {
                // Create new profile if doesn't exist
                $profile = Profile::create([
                    'user_id' => auth()->id(),
                    ...$validated
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Profile created successfully',
                    'data' => $profile
                ], 201);
            } else {
                // Update existing profile
                $profile->update($validated);

                return response()->json([
                    'status' => true,
                    'message' => 'Profile updated successfully',
                    'data' => $profile
                ], 200);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update profile',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }
}