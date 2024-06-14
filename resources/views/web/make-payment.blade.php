@extends('web.layouts.app')
@section('content')
    <style>
        /* Custom styles for mobile view */
        @media (max-width: 767px) {
            #mobile_view {
                display: block !important; /* Show the mobile view section */
            }

            #desktop_view {
                display: none !important; /* Hide the desktop view section */
            }

            .table-responsive {
                margin-bottom: 20px; /* Add spacing between tables */
            }

            /* Adjust form inputs for mobile view */
            .form-group {
                margin-bottom: 15px; /* Add spacing between form groups */
            }

            .form-control {
                width: 100%; /* Make form controls full width */
            }

            /* Center the "Make Payment" button */
            .btn-block {
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-4">Proceed to Payment</h2>
            <p class="text-center">Pay with credit card or debit card or net banking</p>
            <div class="row">
                <div class="col-md-12 mb-2">
                    {!! Session::forget('success') !!}
                    <form action="{!!route('payment-success')!!}" method="POST">
                        @csrf
                        <input type="hidden" name="temp_booking_id" value="{{$tempBooking->id}}">
                        <button class="btn btn-block text-center btn-success" type="button" id="payButton">Pay
                            Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('payButton').addEventListener('click', function () {
            var options = {
                "key": "{{ env('TEST_RAZORPAY_KEY') }}",
                "amount": '{{$amount}}',
                "currency": "INR",
                "name": "Turf Booking Payment",
                "description": "Purchase Description",
                "order_id": '{{$id}}',
                "handler": function (response) {
                    window.location.href = '/payment-success?payment_id=' + response.razorpay_payment_id
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        });
    </script>
@endsection
