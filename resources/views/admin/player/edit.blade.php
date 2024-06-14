@extends('admin.layouts.master')
@section('title','Player')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Player</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Player</h5>
                </div>
                <div class="card-body">
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form">
                        @csrf
                        <input type="hidden" id="edit_value" value="{{$player->id}}" name="edit_value">
                        <input type="hidden" id="state_id" value="{{$player->state_id}}" name="state_id">
                        <input type="hidden" id="city_id" value="{{$player->city_id}}" name="city_id">
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{$player->name}}"
                                           placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="mobile_no" class="form-label">Mobile No</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="mobile_no" name="mobile_no"
                                           value="{{$player->mobile_no}}"
                                           placeholder="Mobile No">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{$player->email}}"
                                           placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" id="date_of_birth"
                                           name="date_of_birth"
                                           value="{{$player->date_of_birth}}"
                                           placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <div class="form-group">
                                    <select class="form-select" id="blood_group" name="blood_group">
                                        <option value="">Date of Birth</option>
                                        <option value="A+" @if($player->blood_group=='A+') selected @endif>A+</option>
                                        <option value="A-" @if($player->blood_group=='A-') selected @endif>A-</option>
                                        <option value="B+" @if($player->blood_group=='B+') selected @endif>B+</option>
                                        <option value="B-" @if($player->blood_group=='B-') selected @endif>B-</option>
                                        <option value="AB+" @if($player->blood_group=='AB+') selected @endif>AB+
                                        </option>
                                        <option value="AB-" @if($player->blood_group=='AB-') selected @endif>AB-
                                        </option>
                                        <option value="O+" @if($player->blood_group=='O+') selected @endif>O+</option>
                                        <option value="O-" @if($player->blood_group=='O-') selected @endif>O-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="address" name="address"
                                           value="{{$player->address}}"
                                           placeholder="Address">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="area" class="form-label">Area</label>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="area" name="area"
                                           value="{{$player->area}}"
                                           placeholder="Area">
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="pincode" class="form-label">Pincode</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pincode" name="pincode"
                                           value="{{$player->pincode}}"
                                           placeholder="Pincode">
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="state" class="form-label">State<span
                                        class="text-danger"></span></label>
                                <input type="text" class="form-control tt-input"
                                       placeholder="State" id="state"
                                       name="state" autocomplete="off" spellcheck="false" dir="auto"
                                       value="{{$player->state}}"
                                       style="position: relative; vertical-align: top; background-color: transparent;">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="city" class="form-label">City<span
                                        class="text-danger"></span></label>
                                <input type="text" class="form-control tt-input"
                                       placeholder="City" id="city"
                                       value="{{$player->city}}"
                                       name="city" autocomplete="off" spellcheck="false" dir="auto"
                                       style="position: relative; vertical-align: top; background-color: transparent;">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="location" name="location"
                                           value="{{$player->location}}"
                                           placeholder="Location">
                                    <input type="hidden" id="latitude" value="{{$player->latitude}}" name="latitude"/>
                                    <input type="hidden" id="longitude" value="{{$player->longitude}}" name="longitude"/>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div id="map-canvas" style="height:300px;"></div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit"
                                    class="btn btn-success btn-sm">{{trans('messages.save')}}</button>
                            <a href="{{ route('admin.player.index') }}"
                               class="btn btn-danger btn-sm">{{trans('messages.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        let form_url = '/player'
        let redirect_url = '/player'
        autoCompleteState()
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_API_KEY")}}&libraries=places"
        async defer integrity=""></script>
    <script src="{{URL::asset('assets/custom-js/initMap.js')}}?v={{ time() }}"></script>
    <script src="{{ asset('assets/custom-js/custom/form.js') }}"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                initMap()
            }, 1000)
            setTimeout(function () {
                $('#address').attr('autocomplete', 'new-password')
                $('#state').trigger('change')
                $('#city').trigger('change')
                addMarker('{{ $player->latitude }}', '{{ $player->longitude }}', '{{ $player->location }}')
            }, 1100)
        })
    </script>
@endsection
