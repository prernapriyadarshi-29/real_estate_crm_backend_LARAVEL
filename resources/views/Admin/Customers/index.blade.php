@extends('layouts.admin')

@section('title', 'Customers')

@section('content')

<h2 class="mb-4">All Customers</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($customers as $index => $customer)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone ?? 'N/A' }}</td>

            <td>
                @if($customer->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Blocked</span>
                @endif
            </td>

            <td>
                <a href="/admin/customers/{{ $customer->id }}" class="btn btn-primary btn-sm">
                    View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection