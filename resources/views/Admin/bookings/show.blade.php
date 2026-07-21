@extends('layouts.admin')

@section('title','Booking Details')

@section('content')

<h2 class="mb-4">Booking Details</h2>

<div class="card">
    <div class="card-body">

        <p><strong>Booking ID:</strong> {{ $booking->id }}</p>

        <p><strong>Property ID:</strong> {{ $booking->property_id }}</p>

        <p><strong>User ID:</strong> {{ $booking->user_id ?? 'N/A' }}</p>

        <p><strong>Token Amount:</strong> ₹ {{ number_format($booking->token_amount,2) }}</p>

        <p><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status ?? 'pending') }}</p>

        <p><strong>Status:</strong>

            @if($booking->status=='approved')

                <span class="badge bg-success">Approved</span>

            @elseif($booking->status=='cancelled')

                <span class="badge bg-danger">Cancelled</span>

            @else

                <span class="badge bg-warning text-dark">Pending</span>

            @endif

        </p>

        <hr>

        @if($booking->status!='approved')

        <form action="/admin/bookings/{{ $booking->id }}/approve" method="POST">
            @csrf
            <button class="btn btn-success">
                Approve Booking
            </button>
        </form>

        <br>

        @endif

        @if($booking->status!='cancelled')

        <form action="/admin/bookings/{{ $booking->id }}/cancel" method="POST">
            @csrf
            <button class="btn btn-danger">
                Cancel Booking
            </button>
        </form>

        @endif

        <br>

        <a href="/admin/bookings" class="btn btn-secondary">
            Back
        </a>

    </div>
</div>

@endsection