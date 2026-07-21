@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Book: {{ $property->title }}</h2>

    <form action="/bookings" method="POST">
        @csrf
        <input type="hidden" name="property_id" value="{{ $property->id }}">

        <div class="mb-3">
            <label>Token Amount (₹)</label>
            <input type="number" name="token_amount" class="form-control" required>
        </div>

        <button class="btn btn-success">Book Now</button>
    </form>
</div>
@endsection