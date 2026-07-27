@extends('layouts.admin')

@section('title', 'Booking Details')

@section('content')

<h2 class="mb-4">Booking Details</h2>

<div class="card shadow">

    <div class="card-header">
        <h4>Booking #{{ $booking->id }}</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="250">Customer</th>
                <td>{{ $booking->user->name ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $booking->user->email ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Property</th>
                <td>{{ $booking->property->title ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>City</th>
                <td>{{ $booking->property->city ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Property Price</th>
                <td>₹ {{ number_format($booking->full_price) }}</td>
            </tr>

            <tr>
                <th>Token Amount</th>
                <td>₹ {{ number_format($booking->token_amount) }}</td>
            </tr>

            <tr>
                <th>Payment Status</th>

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

            </tr>

            <tr>
                <th>Booking Status</th>

                <td>

                    @if($booking->status=='confirmed')

                        <span class="badge bg-success">
                            Confirmed
                        </span>

                    @elseif($booking->status=='cancelled')

                        <span class="badge bg-danger">
                            Cancelled
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Pending
                        </span>

                    @endif

                </td>

            </tr>

            <tr>
                <th>Booked On</th>
                <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
            </tr>

        </table>

        <hr>

        @if($booking->status=='pending')

            <form action="/admin/bookings/{{ $booking->id }}/approve"
                  method="POST"
                  class="d-inline">

                @csrf

                <button class="btn btn-success">

                    Confirm Booking

                </button>

            </form>

            <form action="/admin/bookings/{{ $booking->id }}/cancel"
                  method="POST"
                  class="d-inline">

                @csrf

                <button class="btn btn-danger">

                    Cancel Booking

                </button>

            </form>

        @endif

        <a href="/admin/bookings"
           class="btn btn-secondary">

            Back to Bookings

        </a>

    </div>

</div>

@endsection