@extends('layouts.admin')

@section('title', 'Properties')

@section('content')

<h2 class="mb-4">All Properties</h2>

<table class="table table-bordered table-striped">

    <thead>

        <tr>

            <th>S.No.</th>

            <th>Title</th>

            <th>City</th>

            <th>Price</th>

            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        @foreach($properties as $property)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $property->title }}</td>

            <td>{{ $property->city }}</td>

            <td>₹ {{ number_format($property->price) }}</td>

            <td>{{ $property->status }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection