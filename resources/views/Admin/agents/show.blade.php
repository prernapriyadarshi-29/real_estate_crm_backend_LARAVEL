@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Agent Details</h2>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td>{{ $agent->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $agent->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $agent->phone ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Approval Status</th>
        <td>
            @if($agent->approval_status === 'approved')
                <span class="badge bg-success">✓ Approved</span>
            @elseif($agent->approval_status === 'rejected')
                <span class="badge bg-danger">✗ Rejected</span>
            @else
                <span class="badge bg-warning text-dark">⏳ Pending</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Login Status</th>
        <td>
            @if($agent->is_active)
                <span class="badge bg-success">✓ Can Login</span>
            @else
                <span class="badge bg-danger">✗ Cannot Login</span>
            @endif
        </td>
    </tr>
</table>

<!-- APPROVAL ACTIONS - ONLY FOR PENDING AGENTS -->
@if($agent->approval_status === 'pending')
<div class="mb-4 p-3" style="background-color: #f8f9fa; border-radius: 5px;">
    <h5>Approval Actions</h5>
    <p class="text-muted">This agent is pending approval. Approve or reject them here.</p>
    
    <form method="POST" action="/admin/agents/{{ $agent->id }}/approve" style="display:inline;">
        @csrf
        <button class="btn btn-success btn-lg">✓ Approve Agent</button>
    </form>

    <form method="POST" action="/admin/agents/{{ $agent->id }}/reject" style="display:inline;">
        @csrf
        <button class="btn btn-danger btn-lg">✗ Reject Agent</button>
    </form>
</div>
@endif

<!-- LOGIN ACCESS CONTROL - ALWAYS SHOW FOR APPROVED AGENTS -->
@if($agent->approval_status === 'approved')
<div class="mb-4 p-3" style="background-color: #e8f5e9; border-radius: 5px;">
    <h5>Login Access Control</h5>
    <p class="text-muted">Control whether this agent can login to the system.</p>
    
    @if($agent->is_active)
    <form method="POST" action="/admin/agents/{{ $agent->id }}/deactivate" style="display:inline;">
        @csrf
        <button class="btn btn-warning btn-lg">
            <i class="bi bi-lock"></i> Disable Login
        </button>
    </form>
    <p class="text-muted mt-2">Agent can currently login. Click to disable access.</p>
    @else
    <form method="POST" action="/admin/agents/{{ $agent->id }}/activate" style="display:inline;">
        @csrf
        <button class="btn btn-info btn-lg">
            <i class="bi bi-unlock"></i> Enable Login
        </button>
    </form>
    <p class="text-muted mt-2">Agent is currently disabled. Click to enable login access.</p>
    @endif
</div>
@endif

<a href="/admin/agents" class="btn btn-secondary">Back to Agents</a>

@endsection