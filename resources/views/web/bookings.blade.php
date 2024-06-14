@extends('web.layouts.app')
@section('content')
    <style>
        .mobile-view {
            display: none;
        }

        @media (max-width: 767px) {
            td {
                display: block;
                text-align: left;
            }

            .table-responsive {
                overflow-x: auto; /* Enable horizontal scrolling for small screens */
            }

            #hide_mobile {
                display: none;
            }

            .mobile-view {
                display: inline;
            }
        }

        .fw-bold {
            font-weight: bold;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #06064D;
            color: #fff;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover td {
            background-color: transparent;
        }

        .view-link a {
            color: #06064D;
            text-decoration: none;
        }

        .view-link a:hover {
            text-decoration: underline;
        }

    </style>
    <div class="container-fluid turf-details">
        <div class="row mt-4">
            <div class="col-md-12">
                <h2 class="text-center">Booking Details</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr id="hide_mobile">
                            <th>Unique ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Booking Time</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    <span class="fw-bold mobile-view">Unique ID :</span>{{ $booking->unique_id }}
                                </td>
                                <td>
                                    <span class="fw-bold mobile-view">Name :</span>{{ $booking->name }}
                                </td>
                                <td>
                                    <span class="fw-bold mobile-view">Email :</span>{{ $booking->email }}
                                </td>
                                <td>
                                    <span class="fw-bold mobile-view">Mobile No :</span>{{ $booking->mobile_no }}
                                </td>
                                <td>
                                    <span class="fw-bold mobile-view">Booking Time :</span>{{ date('d M, Y',strtotime($booking->booking_date)) }} {{ date('h:i A',strtotime($booking->timeslot)) }}
                                </td>
                                <td class="view-link">
                                    <a href="{{ route('booking-details',[$booking->id]) }}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Your custom scripts here
    </script>
@endsection
