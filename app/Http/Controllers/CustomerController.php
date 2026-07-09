<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Get all customers for logged-in user (with pagination)
    public function index()
    {
        try {
            $customers = Customer::where('user_id', auth()->id())
                                ->paginate(10);
            
            return response()->json([
                'status' => true,
                'message' => 'Customers retrieved successfully',
                'data' => $customers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve customers',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Create a new customer
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string',
                'city' => 'required|string|max:100',
                'status' => 'required|string|max:50',
                'notes' => 'nullable|string'
            ]);

            $customer = Customer::create([
                'user_id' => auth()->id(),
                ...$validated
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Customer added successfully',
                'data' => $customer
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
                'message' => 'Failed to create customer',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Get single customer
    public function show($id)
    {
        try {
            $customer = Customer::where('user_id', auth()->id())
                                ->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Customer retrieved successfully',
                'data' => $customer
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Customer not found',
                'errors' => ['id' => ['Customer does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve customer',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Update customer
    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::where('user_id', auth()->id())
                                ->findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:100',
                'email' => 'sometimes|email|max:100',
                'phone' => 'sometimes|string|max:20',
                'address' => 'nullable|string',
                'city' => 'sometimes|string|max:100',
                'status' => 'sometimes|string|max:50',
                'notes' => 'nullable|string'
            ]);

            $customer->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Customer updated successfully',
                'data' => $customer
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
                'message' => 'Customer not found',
                'errors' => ['id' => ['Customer does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update customer',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }

    // Delete customer
    public function destroy($id)
    {
        try {
            $customer = Customer::where('user_id', auth()->id())
                                ->findOrFail($id);

            $customer->delete();

            return response()->json([
                'status' => true,
                'message' => 'Customer deleted successfully',
                'data' => null
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Customer not found',
                'errors' => ['id' => ['Customer does not exist']]
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete customer',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }
}