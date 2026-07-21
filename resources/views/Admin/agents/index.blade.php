@extends('layouts.admin')
@section('title', 'Agents')
@section('content')

<h2 class="mb-4">All Agents</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($agents as $agent)
        <tr>
            <td>{{ $agent->name }}</td>
            <td>{{ $agent->email }}</td>
            <td>{{ $agent->phone ?? 'N/A' }}</td>
            <td>
                @if($agent->approval_status === 'approved')
                    <span class="badge bg-success">✓ Approved</span>
                @elseif($agent->approval_status === 'rejected')
                    <span class="badge bg-danger">✗ Rejected</span>
                @else
                    <span class="badge bg-warning text-dark">⏳ Pending</span>
                @endif
            </td>
            <td>
                <a href="/admin/agents/{{ $agent->id }}" class="btn btn-primary btn-sm">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection