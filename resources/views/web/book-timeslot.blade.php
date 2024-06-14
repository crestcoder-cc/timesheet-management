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
            <h2 class="section-title text-center mb-4">Book a timeslot</h2>
            <p class="text-center">Please sign in to continue with new booking</p>
            <div class="row">
                <div class="col-md-4" style="display: none" id="mobile_view">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Turf</th>
                                <th>{{$turf->name}}</th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>{{date('d M, Y',strtotime($book_date))}}</th>
                            </tr>
                            <tr>
                                <th>Timeslot</th>
                                <th>{{date('h:i A',strtotime($timeslot->timeslot))}}</th>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <th>Rs.{{$timeslot->hourly_price}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-8 mb-2">
                    <form method="post" id="bookForm">
                        @csrf
                        <input type="hidden" id="time_slot_id" name="time_slot_id" value="{{$timeslot->id}}">
                        <input type="hidden" id="booking_date" name="booking_date" value="{{$book_date}}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="mobile_no" placeholder="Your Mobile No" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Make Payment</button>
                    </form>
                </div>
                <div class="col-md-4 mb-2" id="desktop_view">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Turf</th>
                                <th>{{$turf->name}}</th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>{{date('d M, Y',strtotime($book_date))}}</th>
                            </tr>
                            <tr>
                                <th>Timeslot</th>
                                <th>{{date('h:i A',strtotime($timeslot->timeslot))}}</th>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <th>Rs.{{$timeslot->hourly_price}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $("#date_of_birth").flatpickr({
            enableTime: false,
            maxDate: "today",
            dateFormat: 'Y-m-d'
        })
        let $bookForm = $("#bookForm")
        $bookForm.on('submit', function (e) {
            e.preventDefault()
            let formData = new FormData($bookForm[0]);
            loaderView();
            axios
                .post('/create-temp-booking', formData)
                .then(function (response) {
                    loaderHide()
                    setTimeout(function () {
                        window.location.href = '/make-payment'
                    })
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        })
    </script>
@endsection
