<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->get();
        return view('Admin.agents.index', compact('agents'));
    }

    public function show($id)
    {
        $agent = Agent::findOrFail($id);
        return view('Admin.agents.show', compact('agent'));
    }

    public function approve($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update(['approval_status' => 'approved']);
        return back()->with('success', 'Agent approved');
    }

    public function reject($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update(['approval_status' => 'rejected']);
        return back()->with('success', 'Agent rejected');
    }
}