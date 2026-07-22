@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $property->title }}</h1>
            <p class="text-muted">{{ $property->city }} | {{ $property->address }}</p>
            
            <div class="bg-light p-4 rounded my-4">
                <h3 class="text-primary">₹ {{ number_format($property->price) }}</h3>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>Bedrooms</th>
                    <td>{{ $property->bedrooms }}</td>
                </tr>
                <tr>
                    <th>Bathrooms</th>
                    <td>{{ $property->bathrooms ?? 1 }}</td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>{{ $property->type }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($property->approval_status) }}</td>
                </tr>
            </table>

            <p class="lead">{{ $property->address }}</p>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ready to Book?</h5>
                    <h3 class="text-primary mb-3">₹ {{ number_format($property->price) }}</h3>
                    <a href="/properties/{{ $property->id }}/book" class="btn btn-success btn-lg w-100">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <a href="/" class="btn btn-secondary mt-4">Back to Home</a>
</div>

@endsection
