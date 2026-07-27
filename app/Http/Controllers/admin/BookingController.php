<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['property', 'user'])
            ->latest()
            ->get();

        return view('Admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['property', 'user'])
            ->findOrFail($id);

        return view('Admin.bookings.show', compact('booking'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => 'confirmed',
        ]);

        return back()->with('success', 'Booking confirmed successfully.');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => 'cancelled',
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}