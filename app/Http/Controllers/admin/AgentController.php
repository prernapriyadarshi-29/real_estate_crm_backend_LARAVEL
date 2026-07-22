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
    $agent->approval_status = 'approved';
    $agent->save();
    return back()->with('success', 'Agent approved');
}

public function reject($id)
{
    $agent = User::where('role', 'agent')->findOrFail($id);
    $agent->approval_status = 'rejected';
    $agent->save();
    return back()->with('success', 'Agent rejected');
}

public function activate($id)
{
    $agent = User::where('role', 'agent')->findOrFail($id);
    $agent->is_active = 1;
    $agent->save();
    return back()->with('success', 'Agent can login now');
}

public function deactivate($id)
{
    $agent = User::where('role', 'agent')->findOrFail($id);
    $agent->is_active = 0;
    $agent->save();
    return back()->with('success', 'Agent login disabled');
}
}