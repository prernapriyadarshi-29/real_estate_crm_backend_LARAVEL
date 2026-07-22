@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<div class="container-fluid bg-light py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Find Your Dream Property</h1>
        <p class="lead text-muted">Explore thousands of properties available for sale and rent</p>
        <div class="mt-4">
            <input type="text" class="form-control form-control-lg" placeholder="Search by city, location..." style="max-width: 500px; margin: 0 auto;">
        </div>
    </div>
</div>

<!-- FEATURED PROPERTIES SECTION -->
@if($featuredProperties->count() > 0)
<div class="container py-5">
    <h2 class="mb-4">⭐ Featured Properties</h2>
    <div class="row g-4">
        @foreach($featuredProperties as $property)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $property->title }}</h5>
                    <p class="text-muted small">{{ $property->city }}</p>
                    <p class="text-primary fw-bold">₹ {{ number_format($property->price) }}</p>
                    <p class="small">
                        <i class="bi bi-door-closed"></i> {{ $property->bedrooms }} BHK |
                        <i class="bi bi-droplet"></i> {{ $property->bathrooms ?? 1 }} Baths
                    </p>
                    <a href="/properties/{{ $property->id }}" class="btn btn-primary w-100">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- ALL PROPERTIES SECTION -->
<div class="container py-5">
    <h2 class="mb-4">All Properties</h2>
    <div class="row g-4">
        @foreach($allProperties as $property)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h6 class="card-title">{{ $property->title }}</h6>
                    <p class="text-muted small">{{ $property->city }}</p>
                    <p class="text-primary fw-bold">₹ {{ number_format($property->price) }}</p>
                    <p class="small">
                        <i class="bi bi-door-closed"></i> {{ $property->bedrooms }} BHK
                    </p>
                    <a href="/properties/{{ $property->id }}" class="btn btn-sm btn-outline-primary w-100">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $allProperties->links() }}
    </div>
</div>

@endsection