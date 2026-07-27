@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h2>Booking Confirmation</h2>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking Details</h5>

                    <table class="table">
                        <tr>
                            <th>Booking ID</th>
                            <td>#{{ $booking->id }}</td>
                        </tr>
                        <tr>
                            <th>Property</th>
                            <td>
                                <a href="/properties/{{ $booking->property->id }}">
                                    {{ $booking->property->title }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{ $booking->property->city }}</td>
                        </tr>
                        <tr>
                            <th>Token Amount</th>
                            <td>₹ {{ number_format($booking->token_amount) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($booking->status === 'confirmed')
                                    <span class="badge bg-success">✓ Confirmed</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="badge bg-danger">✗ Cancelled</span>
                                @else
                                    <span class="badge bg-warning">⏳ Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>
                                @if($booking->payment_status === 'completed')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Booked On</th>
                            <td>{{ $booking->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="/my-bookings" class="btn btn-primary">View All Bookings</a>
                <a href="/" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="alert alert-info">
                <h6>Next Steps</h6>
                <p>Your booking has been created. Admin will review and confirm soon.</p>
            </div>
        </div>
    </div>
</div>

@endsection