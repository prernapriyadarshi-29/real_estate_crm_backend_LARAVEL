@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h2 class="mb-4">My Bookings</h2>

    @if($bookings->count())

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Property</th>
                        <th>City</th>
                        <th>Property Price</th>
                        <th>Token</th>
                        <th>Booking Status</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                @foreach($bookings as $booking)

                    <tr>

                        <td>#{{ $booking->id }}</td>

                        <td>{{ $booking->property->title }}</td>

                        <td>{{ $booking->property->city }}</td>

                        <td>
                            ₹ {{ number_format($booking->full_price) }}
                        </td>

                        <td>
                            ₹ {{ number_format($booking->token_amount) }}
                        </td>

                        <td>

                            @if($booking->status=='pending')

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            @elseif($booking->status=='confirmed')

                                <span class="badge bg-success">
                                    Confirmed
                                </span>

                            @elseif($booking->status=='completed')

                                <span class="badge bg-primary">
                                    Completed
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Cancelled
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($booking->payment_status=='pending')

                                <span class="badge bg-secondary">
                                    Pending
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Paid
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="/bookings/{{ $booking->id }}"
                               class="btn btn-primary btn-sm">

                                View

                            </a>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="alert alert-info">

            You have not booked any property yet.

        </div>

    @endif

</div>

@endsection