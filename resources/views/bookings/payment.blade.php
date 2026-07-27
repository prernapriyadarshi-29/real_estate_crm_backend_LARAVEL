@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h2>Complete Payment</h2>

    <div class="card mt-4">
        <div class="card-body">

            <h4>{{ $booking->property->title }}</h4>

            <h5 class="mt-3">
                Token Amount:
                ₹{{ number_format($booking->token_amount,2) }}
            </h5>

            <button id="rzp-button" class="btn btn-success btn-lg mt-3">
                Pay ₹{{ number_format($booking->token_amount,2) }}
            </button>

        </div>
    </div>

</div>

<form id="payment-success"
      method="POST"
      action="/bookings/{{ $booking->id }}/payment-success">

    @csrf

    <input type="hidden"
           name="razorpay_payment_id"
           id="razorpay_payment_id">

</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

var options = {

    key: "{{ $razorpayKey }}",

    amount: "{{ $booking->token_amount * 100 }}",

    currency: "INR",

    name: "Real Estate CRM",

    description: "Property Booking",

    handler: function (response) {

        document.getElementById('razorpay_payment_id').value =
            response.razorpay_payment_id;

        document.getElementById('payment-success').submit();
    }

};

var rzp = new Razorpay(options);

document.getElementById('rzp-button').onclick = function(e){

    rzp.open();

    e.preventDefault();

}

</script>

@endsection