@extends('web.layouts.app')
@section('content')
    <div class="container-fluid turf-details">
        <div class="row mb-3">
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($turf->images as $key=>$image)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"
                                class="@if($key==0) active @endif"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @if($turf->images)
                            @foreach($turf->images as $key=>$image)
                                <div class="carousel-item @if($key==0) active @endif">
                                    <img src="{{asset($image->image)}}" class="d-block"
                                         style="max-width:400px;"
                                         alt="Turf Image 1">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img src="{{asset('web/assets/img/turf1.jpeg')}}" class="d-block w-100"
                                     alt="Turf Image 1">
                            </div>
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="turf-details">
                    <h1 class="turf-name">{{$turf->name}}</h1>
                    <p class="turf-address">Location: {{$turf->address}},{{$turf->area}},{{$turf->city}} <a
                                href="https://maps.google.com/?q={{$turf->latitude}},{{$turf->longitude}}"
                                target="_blank">
                            <i class="fas fa-map-marker-alt"></i> Get Directions</a></p>
                    <div class="rating">
                        <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                        <span class="rating-value">4.5/5</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <!-- Custom Tab Design -->
                <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="book-tab" data-toggle="tab" href="#book" role="tab"
                           aria-controls="book" aria-selected="true">Book Slot</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab"
                           aria-controls="details" aria-selected="false">Details</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">

                    <div class="tab-pane fade show active" id="book" role="tabpanel" aria-labelledby="book-tab">
                        <!--<div class="booking-cards-flex">
                            <div class="booking-card mr-3 mb-3">
                                <div class="card-top">
                                    <div>
                                        <p class="facility-name">5v5 Turf 1</p>
                                        <p class="time-range">06:00 AM to 11:00 PM</p>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <span class="price">₹ 1249</span>
                                        </div>
                                        <span class="price-description">onwards</span>
                                    </div>
                                    <button data-target="#collapseExample" aria-expanded="false"
                                            aria-controls="collapseExample" type="button"
                                            class="btn btn-primary btn-book">Book
                                    </button>
                                </div>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Date picker -->
                                <label for="date">Select Date:</label>
                                <input type="hidden" id="turf_id" value="{{$turf->id}}"/>
                                <input type="text" id="book_date" name="book_date" class="form-control date-picker mb-3"/>
                            </div>
                        </div>
                        <div class="row" id="timeSlotsContainer">
                        </div>
                    </div>
                    <!-- Details Tab -->
                    <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                        <div class="card shadow">
                            <div class="card-body">
                                <h3 class="card-title">Description</h3>
                                <p class="card-text">
                                    {!! $turf->facility_provided !!}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.timeslot-click', function () {
            const book_date = $('#book_date').val()
            let timeslot_id = $(this).data('timeslot')
            window.location.href = '/book-timeslot?timeslot=' + timeslot_id + '&book_date=' + book_date;
        })

        $("#book_date").on('change', function () {
            const book_date = $(this).val()
            const turf_id = $('#turf_id').val()
            // loaderView()
            axios
                .post('/get-booking-slot', {book_date: book_date, turf_id: turf_id})
                .then(function (response) {
                    // loaderHide()
                    $("#timeSlotsContainer").html(response.data.data)
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    // loaderHide()
                })
        })
    </script>
@endsection
