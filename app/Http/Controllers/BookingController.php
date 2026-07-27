<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Errors\SignatureVerificationError;

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
        $booking = Booking::with(['property', 'user'])->findOrFail($id);
        
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('bookings.show', compact('booking'));
    }

    public function payment($id)
{
    $booking = Booking::with('property')->findOrFail($id);

    if ($booking->user_id != auth()->id()) {
        abort(403);
    }

    return view('bookings.payment', [
        'booking' => $booking,
        'razorpayKey' => env('RAZORPAY_KEY')
    ]);
}

public function paymentSuccess(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    $api = new Api(
        env('RAZORPAY_KEY'),
        env('RAZORPAY_SECRET')
    );

    try {

        $attributes = [

            'razorpay_order_id' => $request->razorpay_order_id,

            'razorpay_payment_id' => $request->razorpay_payment_id,

            'razorpay_signature' => $request->razorpay_signature,

        ];

        $api->utility->verifyPaymentSignature($attributes);

    } catch (SignatureVerificationError $e) {

        return redirect("/bookings/$id")
            ->with('error', 'Payment verification failed.');

    }

    $booking->update([

        'payment_status' => 'completed',

        'status' => 'confirmed',

        'razorpay_payment_id' => $request->razorpay_payment_id,

    ]);

    return redirect("/bookings/$id")
        ->with('success', 'Payment Successful.');

}

    public function myBookings()
{
    $bookings = Booking::with('property')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('bookings.my-bookings', compact('bookings'));
}
}