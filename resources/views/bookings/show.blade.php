@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Booking Confirmed!</h2>

    <table class="table">
        <tr>
            <th>Booking ID</th>
            <td>#{{ $booking->id }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>₹{{ $booking->token_amount }}</td>
        </tr>
    </table>

    <a href="/properties" class="btn btn-secondary">Back</a>
</div>
@endsection