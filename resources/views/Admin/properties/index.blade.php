@extends('layouts.admin')

@section('title', 'Properties')

@section('content')

<h2 class="mb-4">All Properties</h2>

<table class="table table-bordered table-striped">

    <thead>

        <tr>

            <th>S.No.</th>

            <th>Title</th>

            <th>City</th>

            <th>Price</th>

            <th>Status</th>

            <th>Approval</th>

            <th>Action</th>

        </tr>

    </thead>

    <tbody>

        @foreach($properties as $property)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $property->title }}</td>

            <td>{{ $property->city }}</td>

            <td>₹ {{ number_format($property->price) }}</td>

            <td>{{ $property->status }}</td>

           <td>
    @if($property->approval_status === 'approved')
        <span class="badge bg-success">✓ Approved</span>
    @elseif($property->approval_status === 'rejected')
        <span class="badge bg-danger">✗ Rejected</span>
    @else
        <span class="badge bg-warning text-dark">⏳ Pending</span>
    @endif
</td>

            <td>
        <a href="/admin/properties/{{ $property->id }}" class="btn btn-primary btn-sm">
            View
        </a>
    </td>


        </tr>

        @endforeach

    </tbody>

</table>

@endsection