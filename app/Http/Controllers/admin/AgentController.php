<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = User::where('role', 'agent')->latest()->get();
        return view('Admin.agents.index', compact('agents'));
    }

    public function show($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        return view('Admin.agents.show', compact('agent'));
    }

    public function approve($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        $agent->update(['is_active' => 1]);
        return back()->with('success', 'Agent activated');
    }

    public function reject($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        $agent->update(['is_active' => 0]);
        return back()->with('success', 'Agent deactivated');
    }
}