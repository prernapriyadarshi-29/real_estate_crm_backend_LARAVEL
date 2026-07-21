<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($propertyId)
    {
        $property = Property::where('approval_status', 'approved')->findOrFail($propertyId);
        return view('bookings.create', compact('property'));
    }

    public function store(Request $request)
    {
        $booking = Booking::create([
            'property_id' => $request->property_id,
            'token_amount' => $request->token_amount,
            'status' => 'pending'
        ]);

        return redirect("/bookings/{$booking->id}");
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
    }
}