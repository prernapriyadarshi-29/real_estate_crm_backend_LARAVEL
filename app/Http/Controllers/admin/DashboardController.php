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

        return view('Admin.dashboard', compact(
            'totalProperties',
            'totalAgents',
            'totalCustomers'
        ));
    }
}