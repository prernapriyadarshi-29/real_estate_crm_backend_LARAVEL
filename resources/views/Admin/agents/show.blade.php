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
        <th>Status</th>
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
</table>

@if($agent->approval_status === 'pending')
<form method="POST" action="/admin/agents/{{ $agent->id }}/approve" style="display:inline;">
    @csrf
    <button class="btn btn-success">✓ Approve</button>
</form>

<form method="POST" action="/admin/agents/{{ $agent->id }}/reject" style="display:inline;">
    @csrf
    <button class="btn btn-danger">✗ Reject</button>
</form>
@endif

<a href="/admin/agents" class="btn btn-secondary">Back</a>

@endsection