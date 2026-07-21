@extends('layouts.admin')

@section('title', 'User Details')

@section('content')

<h2 class="mb-4">User Details</h2>

<div class="card">
    <div class="card-body">

        <p><strong>Name:</strong> {{ $user->name }}</p>

        <p><strong>Email:</strong> {{ $user->email }}</p>

        <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>

        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

        <p>
            <strong>Status:</strong>

            @if($user->is_active)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Blocked</span>
            @endif
        </p>

        <hr>

        @if($user->is_active)

            <form action="/admin/users/{{ $user->id }}/block" method="POST">
                @csrf
                <button class="btn btn-danger">
                    Block User
                </button>
            </form>

        @else

            <form action="/admin/users/{{ $user->id }}/activate" method="POST">
                @csrf
                <button class="btn btn-success">
                    Activate User
                </button>
            </form>

        @endif

        <br>

        <a href="/admin/users" class="btn btn-secondary">
            Back
        </a>

    </div>
</div>

@endsection