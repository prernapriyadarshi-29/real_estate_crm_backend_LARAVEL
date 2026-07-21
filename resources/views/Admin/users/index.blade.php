@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<h2 class="mb-4">All Users</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>{{ $user->phone ?? 'N/A' }}</td>

            <td>
                @if($user->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Blocked</span>
                @endif
            </td>

            <td>
                <a href="/admin/users/{{ $user->id }}" class="btn btn-primary btn-sm">
                    View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection