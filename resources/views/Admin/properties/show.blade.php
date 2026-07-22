@extends('layouts.admin')

@section('content')

<h2 class="mb-4">Property Details</h2>

<table class="table table-bordered">

    <tr>
        <th>Title</th>
        <td>{{ $property->title }}</td>
    </tr>

    <tr>
        <th>City</th>
        <td>{{ $property->city }}</td>
    </tr>

    <tr>
        <th>Price</th>
        <td>₹ {{ number_format($property->price) }}</td>
    </tr>

    <tr>
        <th>Bedrooms</th>
        <td>{{ $property->bedrooms }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>{{ $property->status }}</td>
    </tr>

    <tr>
        <th>Approval Status</th>
        <td>
            @if($property->approval_status === 'approved')
            <span class="badge bg-success">✓ Approved</span>
            @elseif($property->approval_status === 'rejected')
            <span class="badge bg-danger">✗ Rejected</span>
            @else
            <span class="badge bg-warning text-dark">⏳ Pending</span>
            @endif
        </td>
    </tr>

</table>

@if($property->approval_status === 'pending')
<div class="mb-3">
    <form method="POST" action="/admin/properties/{{ $property->id }}/approve" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-success">✓ Approve</button>
    </form>

    <form method="POST" action="/admin/properties/{{ $property->id }}/reject" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">✗ Reject</button>
    </form>
</div>
@endif

<div class="mb-3 mt-4">
    <h5>Featured Status</h5>
    @if($property->is_featured)
        <span class="badge bg-warning text-dark mb-3">⭐ Featured</span>
        <form method="POST" action="/admin/properties/{{ $property->id }}/unmark-featured" style="display:inline;">
            @csrf
            <button class="btn btn-warning">Remove from Featured</button>
        </form>
    @else
        <span class="badge bg-secondary mb-3">Not Featured</span>
        <form method="POST" action="/admin/properties/{{ $property->id }}/mark-featured" style="display:inline;">
            @csrf
            <button class="btn btn-success">⭐ Mark as Featured</button>
        </form>
    @endif
</div>

<a href="/admin/properties" class="btn btn-secondary">
    Back
</a>

@endsection