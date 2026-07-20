<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::count();

        $totalAgents = User::where('role', 'agent')->count();

        $totalUsers = User::where('role', 'user')->count();

        return view('Admin.dashboard', compact(
            'totalProperties',
            'totalAgents',
            'totalUsers'
        ));
    }
}