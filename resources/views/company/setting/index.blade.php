@extends('company.layouts.master')
@section('title')
    Setting
@endsection
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>
            <span>/</span>
            <span>Settings</span>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="holiday-setting-tab" data-bs-toggle="tab"
                                    data-bs-target="#holiday_setting" type="button" role="tab"
                                    aria-controls="holiday_setting" aria-selected="true">
                                <i class="bi bi-house fs-2 me-2"></i>Holiday Management
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="holiday_setting" role="tabpanel"
                             aria-labelledby="holiday-setting-tab">
                            <form id="holiday_form" class="form" method="POST">
                                @csrf
                                <div class="row mb-2 mt-2">
                                    <div class="chart-heading">
                                        <h3>Holiday Management</h3>
                                    </div>
                                </div>
                                @if(count($holidays) > 0)
                                    @php
                                        $i = 0;
                                    @endphp
                                    <div id="holiday_fields">
                                        @foreach($holidays as $index => $holiday)
                                            <div class="holiday-row row mb-3" id="holiday_row_{{$index + 1}}">
                                                <div class="col-md-2 text-md-start">
                                                    <label for="holiday_title_{{$index + 1}}" class="form-label"><span
                                                            class="required">Holiday Title</span></label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                           id="holiday_title_{{$index + 1}}"
                                                           name="holiday_title[{{$index + 1}}]" value="{{$holiday->title}}"
                                                           placeholder="Holiday Title">
                                                </div>

                                                <div class="col-md-2 text-md-start ">
                                                    <label for="holiday_date_{{$index + 1}}" class="form-label"><span
                                                            class="required">Holiday Date</span></label>
                                                </div>
                                                <div class="col-md-3 d-flex">
                                                    <input type="date" id="holiday_date_{{$index + 1}}"
                                                           value="{{$holiday->date}}" name="holiday_date[{{$index + 1}}]"
                                                           class="form-control" placeholder="Select date">
                                                </div>
                                                <div class="col-md-1 d-flex align-items-center">
                                                    @if($index === 0)
                                                        <button type="button" class="btn btn-success btn-sm ms-2 add_field">
                                                            +
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm ms-2 remove_field">-
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div id="holiday_fields">
                                        <div class="holiday-row row mb-3" id="holiday_row_1">
                                            <div class="col-md-2 text-md-start">
                                                <label for="holiday_title_1" class="form-label"><span class="required">Holiday Title</span></label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" id="holiday_title_1"
                                                       name="holiday_title[1]" placeholder="Holiday Title">
                                            </div>

                                            <div class="col-md-2 text-md-start">
                                                <label for="holiday_date_1" class="form-label"><span
                                                        class="required">Holiday Date</span></label>
                                            </div>
                                            <div class="col-md-3 d-flex">
                                                <input type="date" id="holiday_date_1"
                                                       name="holiday_date[1]"
                                                       class="form-control" placeholder="Select date">
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center">
                                                <button type="button" class="btn btn-success btn-sm ms-2 add_field">+
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn btn-dark" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var holiday_form_url = '/holiday-date-store';
        var redirect_url = '/setting';
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });

        $(document).ready(function () {
            var i = {{ count($holidays) > 0 ? count($holidays) : 0 }}; // Initialize i with count of existing holidays

            $('.add_field').click(function () {
                i++;

                var newHolidayField = `
<div id="holiday_fields">
                                    <div class="holiday-row row mb-3" id="holiday_row_${i}">
                                        <div class="col-md-2 text-md-start">
                                            <label for="holiday_title_${i}" class="form-label"><span class="required">Holiday Title</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" id="holiday_title_${i}"
                                                   name="holiday_title[${i}]" placeholder="Holiday Title">
                                        </div>

                                        <div class="col-md-2 text-md-start">
                                            <label for="holiday_date_${i}" class="form-label"><span
                                                    class="required">Holiday Date</span></label>
                                        </div>
                                        <div class="col-md-3 d-flex">
                                            <input type="date" id="holiday_date_${i}"
                                                 name="holiday_date[${i}]"
                                                   class="form-control" placeholder="Select date">
                                        </div>
 <div class="col-md-1 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger btn-sm ms-2 remove_field">-
                                            </button>
                                        </div>
                                    </div>
                                </div>

        `;

                // Append new holiday fields after the last existing holiday row
                $('#holiday_fields').children('.holiday-row').last().after(newHolidayField);
            });

            $(document).on('click', '.remove_field', function () {
                $(this).closest('.row').next('.row').remove(); // Remove date field row
                $(this).closest('.row').remove(); // Remove title field row
            });

            // Initialize date picker
            $(document).on('focus', '.dob-date-picker', function () {
                $(this).datepicker();
            });
        });
    </script>
    <script src="{{URL::asset('assets/company/custom/setting.js')}}?v={{ time() }}"></script>
@endsection
