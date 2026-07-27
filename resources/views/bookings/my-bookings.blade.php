@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h2>My Bookings</h2>

    @if($bookings->count() === 0)
        <div class="alert alert-info mt-4">
            You haven't booked any properties yet. <a href="/properties">Browse properties</a>
        </div>
    @else
        <table class="table table-bordered mt-4">
            <thead class="table-light">
                <tr>
                    <th>Booking ID</th>
                    <th>Property</th>
                    <th>Token Amount</th>
                    <th>Status</th>
                    <th>Booked On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>#{{ $booking->id }}</td>
                    <td>{{ $booking->property->title }}</td>
                    <td>₹ {{ number_format($booking->token_amount) }}</td>
                    <td>
                        @if($booking->status === 'confirmed')
                            <span class="badge bg-success">✓ Confirmed</span>
                        @elseif($booking->status === 'cancelled')
                            <span class="badge bg-danger">✗ Cancelled</span>
                        @else
                            <span class="badge bg-warning">⏳ Pending</span>
                        @endif
                    </td>
                    <td>{{ $booking->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="/bookings/{{ $booking->id }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection