@extends('layouts.admin')

@section('title', 'Bookings')

@section('content')

<h2 class="mb-4">All Bookings</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Property ID</th>
            <th>User ID</th>
            <th>Token Amount</th>
            <th>Payment Status</th>
            <th>Booking Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($bookings as $index => $booking)

        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $booking->property_id }}</td>
            <td>{{ $booking->user_id ?? 'N/A' }}</td>
            <td>₹ {{ number_format($booking->token_amount,2) }}</td>
            <td>

    @if($booking->payment_status=='completed')

        <span class="badge bg-success">
            Paid
        </span>

    @else

        <span class="badge bg-warning text-dark">
            Pending
        </span>

    @endif

</td>
            <td>
                @if($booking->status=='approved')
                    <span class="badge bg-success">Approved</span>

                @elseif($booking->status=='cancelled')
                    <span class="badge bg-danger">Cancelled</span>

                @else
                    <span class="badge bg-warning text-dark">Pending</span>

                @endif
            </td>

            <td>
                <a href="/admin/bookings/{{ $booking->id }}" class="btn btn-primary btn-sm">
                    View
                </a>
            </td>

        </tr>

        @empty

        <tr>
            <td colspan="7" class="text-center">
                No Bookings Found
            </td>
        </tr>

        @endforelse
    </tbody>
</table>

@endsection