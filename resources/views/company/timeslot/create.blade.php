@extends('company.layouts.master')
@section('title','Timeslots')
@section('content')
    <style>
        .tableFixHead {
            height: 400px;
            overflow: scroll;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Timeslots</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Timeslots</h5>
                </div>
                <div class="card-body">
                    <form method="POST" data-parsley-validate="" id="addEditForm" role="form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            <div class="col-lg-10 mb-3">
                                <label for="all_price">All Price</label>
                                <input type="number" placeholder="All Price" class="form-control" name="all_price"
                                       id="all_price"/>
                            </div>
                            <div class="col-lg-2 mb-3">
                                <button type="button" style="margin-top: 28px;" class="btn btn-success"
                                        id="apply_price">Apply
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                @foreach($days as $key=>$day)
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link @if($key === 0)  active @endif"
                                           data-bs-toggle="tab"
                                           href="#days_{{$key}}"
                                           @if($key === 0)   aria-selected="true" @endif
                                           role="tab">
                                            {{$day}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content text-muted">
                                @foreach($days as $key=>$day)
                                    <div class="tab-pane @if($key === 0)  active @endif" id="days_{{$key}}"
                                         role="tabpanel">
                                        <div id="time-slot-{{$key}}" style="width: 100%">
                                            <div class="tableFixHead">
                                                <table class="table table-bordered"
                                                       aria-describedby="Time Slot">
                                                    <thead>
                                                    <tr class="thead-dark">
                                                        <th class="p-2">Timeslot</th>
                                                        <th class="p-2">On / Off</th>
                                                        <th class="p-2">Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($slots as $key2=>$time)
                                                        @php($turfTimeslot=App\Models\TurfTimeslot::where('user_id', $user->id)->where('day', $day)->where('timeslot', $time)->first())
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" class="form-control"
                                                                       id="time_slot"
                                                                       name="time_slot[{{$day}}][{{$key2}}]"
                                                                       value="{{$time}}"
                                                                       readonly>
                                                                <label
                                                                        for="{{$time}}">{{\Carbon\Carbon::parse($time)->format('h:i A')}}</label>
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-check-inline form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="timeslot_status[{{$day}}][{{$key2}}]"
                                                                           id="yes"
                                                                           value="1"
                                                                           @if(isset($turfTimeslot) && $turfTimeslot->status===1) checked
                                                                           @elseif(!isset($turfTimeslot)) checked @endif>
                                                                    <label class="form-check-label"
                                                                           for="yes">
                                                                        Yes
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="timeslot_status[{{$day}}][{{$key2}}]"
                                                                           id="yes"
                                                                           value="0"
                                                                           @if(isset($turfTimeslot) && $turfTimeslot->status===0) checked
                                                                            @endif>
                                                                    <label class="form-check-label"
                                                                           for="no">
                                                                        No
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="number"
                                                                       class="all_price_value form-control"
                                                                       placeholder="Hourly Price"
                                                                       value="{{$turfTimeslot->hourly_price??null}}"
                                                                       name="price[{{$day}}][{{$key2}}]"/>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">{{trans('messages.save')}}</button>
                            <a href="{{ route('turf.dashboard') }}"
                               class="btn btn-danger">{{trans('messages.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var form_url = '/company-timeslot'
        var redirect_url = '/company-timeslot'
        $('#apply_price').on('click', function () {
            if ($('#all_price').val() != '') {
                $(".all_price_value").val($('#all_price').val())
            } else {
                $(".all_price_value").val('')
            }
        })
    </script>
    <script src="{{ asset('assets/custom-js/custom/form.js') }}"></script>
@endsection
