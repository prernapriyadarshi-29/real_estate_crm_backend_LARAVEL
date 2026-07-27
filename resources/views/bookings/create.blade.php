@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <h2>Book Property: {{ $property->title }}</h2>

            <div class="card mt-4">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Property</th>
                            <td>{{ $property->title }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
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
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking Details</h5>

                    <form method="POST" action="/bookings">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">

                        <div class="mb-3">
                            <label class="form-label">Token Amount (₹)</label>
                            <input type="number" name="token_amount" class="form-control form-control-lg" 
                                   placeholder="Minimum ₹1,000" min="1000" required>
                            <small class="text-muted">Usually 10% of property price</small>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="/properties/{{ $property->id }}" class="btn btn-secondary mt-4">Cancel</a>
</div>

@endsection