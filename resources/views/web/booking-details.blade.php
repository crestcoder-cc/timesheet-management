@extends('web.layouts.app')
@section('content')
    <style>
        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .info-item:hover {
            background-color: #e9ecef;
        }

        .info-item span:first-child {
            font-weight: bold;
        }

        .info-item a {
            color: #007bff;
            text-decoration: none;
        }

        .info-item a:hover {
            text-decoration: underline;
        }

    </style>
    <div class="container-fluid turf-details">
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="booking-details card">
                    <h2 class="card-title text-center mb-4">Booking Details</h2>
                    <div class="booking-info">
                        <div class="info-item">
                            <span>Unique ID:</span>
                            <span>{{ $booking->unique_id }}</span>
                        </div>
                        <div class="info-item">
                            <span>Name:</span>
                            <span>{{ $booking->name }}</span>
                        </div>
                        <div class="info-item">
                            <span>Email:</span>
                            <span>{{ $booking->email }}</span>
                        </div>
                        <div class="info-item">
                            <span>Mobile No:</span>
                            <span>{{ $booking->mobile_no }}</span>
                        </div>
                        <div class="info-item">
                            <span>Booking Date:</span>
                            <span>{{ date('d M, Y', strtotime($booking->booking_date)) }}</span>
                        </div>
                        <div class="info-item">
                            <span>Timeslot:</span>
                            <span>{{ date('h:i A', strtotime($booking->timeslot)) }}</span>
                        </div>
                        <div class="info-item">
                            <span>Amount:</span>
                            <span>Rs.{{ $booking->amount }}</span>
                        </div>
                        <div class="info-item">
                            <span>Payment Status:</span>
                            <span>{{ $booking->payment_status }}</span>
                        </div>
                        <div class="info-item">
                            <span>Transaction ID:</span>
                            <span>{{ $booking->transaction_id }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="turf-details card">
                    <h2 class="card-title text-center mb-4">Turf Details</h2>
                    <div class="turf-info">
                        <div class="info-item">
                            <span>Name:</span>
                            <span>{{ $booking->turf->name }}</span>
                        </div>
                        <div class="info-item">
                            <span>Email:</span>
                            <span>{{ $booking->turf->email }}</span>
                        </div>
                        <div class="info-item">
                            <span>Mobile No:</span>
                            <span>{{ $booking->turf->mobile_no }}</span>
                        </div>
                        <div class="info-item">
                            <span>Contact Person:</span>
                            <span>{{ $booking->turf->contact_person_name }}</span>
                        </div>
                        <div class="info-item">
                            <span>Address:</span>
                            <span>{{ $booking->turf->address }}, {{ $booking->turf->area }}, {{ $booking->turf->city }}</span>
                        </div>
                        <div class="info-item">
                            <span>Turf Page:</span>
                            <span><a href="{{ route('company-details',[$booking->turf->id]) }}">View</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
