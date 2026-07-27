<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::count();

        $totalAgents = \App\Models\User::where('role', 'agent')->count();
        
        $totalCustomers = \App\Models\Customer::count();

        $totalBookings = \App\Models\Booking::count();

$completedPayments = \App\Models\Booking::where(
    'payment_status',
    'completed'
)->count();

$pendingPayments = \App\Models\Booking::where(
    'payment_status',
    'pending'
)->count();

        return view(
    'Admin.dashboard',
    compact(
        'totalProperties',
        'totalAgents',
        'totalCustomers',
        'totalBookings',
        'completedPayments',
        'pendingPayments'
    )
);
    }
}