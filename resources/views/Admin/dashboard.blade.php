@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Total Properties</h6>
                <h2>{{ $totalProperties }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Total Agents</h6>
                <h2>{{ $totalAgents }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Total Customers</h6>
                <h2>{{ $totalCustomers }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6>Total Bookings</h6>
                <h2>0</h2>
            </div>
        </div>
    </div>

</div>

<div class="card shadow border-0">
    <div class="card-body">

        <h5>Recent Activity</h5>

        <hr>

        <p>No recent activity available.</p>

    </div>
</div>

<div class="row mt-4">

    <div class="col-md-4">

        <div class="card text-bg-primary">

            <div class="card-body">

                <h5>Total Bookings</h5>

                <h2>{{ $totalBookings }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-bg-success">

            <div class="card-body">

                <h5>Paid Bookings</h5>

                <h2>{{ $completedPayments }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-bg-warning">

            <div class="card-body">

                <h5>Pending Payments</h5>

                <h2>{{ $pendingPayments }}</h2>

            </div>

        </div>

    </div>

</div>

@endsection