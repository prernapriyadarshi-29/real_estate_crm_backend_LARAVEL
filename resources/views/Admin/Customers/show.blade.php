@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Customer Details</h2>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td>{{ $customer->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $customer->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $customer->phone ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if($customer->is_active)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Blocked</span>
            @endif
        </td>
    </tr>
</table>

<div class="mb-3 mt-4">
    @if($customer->is_active)
    <form method="POST" action="/admin/customers/{{ $customer->id }}/block" style="display:inline;">
        @csrf
        <button class="btn btn-danger btn-lg">Block Customer</button>
    </form>
    @else
    <form method="POST" action="/admin/customers/{{ $customer->id }}/activate" style="display:inline;">
        @csrf
        <button class="btn btn-success btn-lg">Activate Customer</button>
    </form>
    @endif
</div>

<a href="/admin/customers" class="btn btn-secondary">Back to Customers</a>

@endsection