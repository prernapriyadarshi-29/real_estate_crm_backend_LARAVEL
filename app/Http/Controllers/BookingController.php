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
        
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Please login to book a property');
        }

        return view('bookings.create', compact('property'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'token_amount' => 'required|numeric|min:1000',
        ]);

        $booking = Booking::create([
            'property_id' => $request->property_id,
            'user_id' => auth()->id(),
            'token_amount' => $request->token_amount,
            'payment_status' => 'pending',
            'status' => 'pending'
        ]);

        return redirect("/bookings/{$booking->id}")->with('success', 'Booking created successfully!');
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('bookings.show', compact('booking'));
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', auth()->id())->latest()->get();
        return view('bookings.my-bookings', compact('bookings'));
    }
}