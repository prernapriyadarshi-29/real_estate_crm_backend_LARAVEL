<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Lead;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        try {
            $userId = auth()->id();

            // Get counts for logged-in user only
            $totalProperties = Property::where('user_id', $userId)->count();
            $totalCustomers = Customer::where('user_id', $userId)->count();
            $totalLeads = Lead::where('user_id', $userId)->count();
            
            // Today's followups (leads with follow_up_date = today)
            $todayFollowups = Lead::where('user_id', $userId)
                ->whereDate('follow_up_date', today())
                ->count();

            return response()->json([
                'status' => true,
                'message' => 'Dashboard data retrieved',
                'data' => [
                    'total_properties' => $totalProperties,
                    'total_customers' => $totalCustomers,
                    'total_leads' => $totalLeads,
                    'today_followups' => $todayFollowups,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching dashboard data',
                'errors' => ['error' => [$e->getMessage()]]
            ], 500);
        }
    }
}