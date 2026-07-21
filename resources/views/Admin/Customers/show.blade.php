@extends('layouts.admin')

@section('title', 'Customer Details')

@section('content')

<h2 class="mb-4">Customer Details</h2>

<div class="card">
    <div class="card-body">

        <p><strong>Name:</strong> {{ $customer->name }}</p>

        <p><strong>Email:</strong> {{ $customer->email }}</p>

        <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>

        <p><strong>Role:</strong> {{ ucfirst($customer->role) }}</p>

        <p>
            <strong>Status:</strong>

            @if($customer->is_active)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Blocked</span>
            @endif
        </p>

        <hr>

        @if($customer->is_active)

            <form action="/admin/customers/{{ $customer->id }}/block" method="POST">
                @csrf
                <button class="btn btn-danger">
                    Block Customer
                </button>
            </form>

        @else

            <form action="/admin/customers/{{ $customer->id }}/activate" method="POST">
                @csrf
                <button class="btn btn-success">
                    Activate Customer
                </button>
            </form>

        @endif

        <br>

        <a href="/admin/customers" class="btn btn-secondary">
            Back
        </a>

    </div>
</div>

@endsection