@extends('admin.layouts.master')
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
                        <button class="nav-link active" id="general-setting-tab" data-bs-toggle="tab"
                                data-bs-target="#general_setting" type="button" role="tab"
                                aria-controls="general_setting" aria-selected="true">
                            <i class="bi bi-house fs-2 me-2"></i>General
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="email-setting-tab" data-bs-toggle="tab"
                                data-bs-target="#email_setting" type="button" role="tab"
                                aria-controls="email_setting" aria-selected="true">
                            <i class="bi bi-house fs-2 me-2"></i>Email
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-setting-tab" data-bs-toggle="tab"
                                data-bs-target="#contact_info" type="button" role="tab"
                                aria-controls="contact_info" aria-selected="true">
                            <i class="bi bi-house fs-2 me-2"></i>Contact Info
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="social-media-setting-tab" data-bs-toggle="tab"
                                data-bs-target="#social_media_setting" type="button" role="tab"
                                aria-controls="social_media_setting" aria-selected="true">
                            <i class="bi bi-house fs-2 me-2"></i>Social Media
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="holiday-setting-tab" data-bs-toggle="tab"
                                data-bs-target="#holiday_setting" type="button" role="tab"
                                aria-controls="holiday_setting" aria-selected="true">
                            <i class="bi bi-house fs-2 me-2"></i>Holiday Management
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="general_setting" role="tabpanel"
                         aria-labelledby="general-setting-tab">
                        <form id="general_setting_form" class="form" action="#">
                            <div class="row mb-2 mt-2">
                                <div class="chart-heading">
                                    <h3>General Setting</h3>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'LOGO_IMG' || (string)$setting->setting_key === 'FAVICON_IMG')
                                    <div class="row mb-3">
                                        <div class="col-md-2 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label">  {{str_replace('_',' ',$setting->setting_key)}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="file" class="form-control dropify"
                                                       id="{{$setting->setting_key}}" name="{{$setting->setting_key}}"
                                                       data-default-file="{{asset($setting->setting_value)}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if((string)$setting->setting_key === 'SITE_TITLE')
                                    <div class="row mb-3">
                                        <div class="col-md-2 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label">{{str_replace('_',' ',$setting->setting_key)}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control"
                                                   name="setting_key[{{$setting->setting_key}}]"
                                                   id="{{$setting->setting_key}}" value="{{$setting->setting_value}}"/>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-dark" type="submit">Submit</button>

                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="email_setting" role="tabpanel"
                         aria-labelledby="email-setting-tab">
                        <form id="email_setting_form" class="form" action="#">
                            <div class="row mb-2 mt-2">
                                <div class="chart-heading">
                                    <h3>Email Setting</h3>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'SMTP_HOST' || (string)$setting->setting_key === 'SMTP_PORT' || (string)$setting->setting_key === 'SMTP_USERNAME'
                                      || (string)$setting->setting_key === 'SMTP_PASSWORD' || (string)$setting->setting_key === 'FROM_EMAIL' || (string)$setting->setting_key === 'FROM_EMAIL_TITLE')
                                    <div class="row mb-3">
                                        <div class="col-md-2 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       id="{{$setting->setting_key}}"
                                                       name="setting_key[{{$setting->setting_key}}]"
                                                       value="{{$setting->setting_value}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if((string)$setting->setting_key === 'SMTP_SCHEME')
                                    <div class="row mb-3">
                                        <div class="col-md-2 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>

                                        <div class="col-md-10">
                                            <select id="smtp_scheme"
                                                    class="form-select form-select-solid fw-bolder"
                                                    name="setting_key[{{$setting->setting_key}}]"
                                                    data-parsley-errors-container="#smtp_scheme_error">
                                                <option
                                                    value="">Select Option
                                                </option>
                                                <option value="SSL"
                                                        @if((string)$setting->setting_value === 'SSL') selected @endif>
                                                    SSL
                                                </option>
                                                <option value="TLS"
                                                        @if((string)$setting->setting_value === 'TLS') selected @endif>
                                                    TLS
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-dark" type="submit">Submit</button>

                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="contact_info" role="tabpanel"
                         aria-labelledby="contact-setting-tab">
                        <form id="contact_info_form" class="form" action="#">
                            <div class="row mb-2 mt-2">
                                <div class="chart-heading">
                                    <h3>Contact Info Setting</h3>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'CONTACT_NUMBER_1' || (string)$setting->setting_key === 'CONTACT_NUMBER_2' || (string)$setting->setting_key === 'WHATSAPP_NUMBER')
                                    <div class="row mb-3">
                                        <div class="col-md-3 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control integer"
                                                       id="{{$setting->setting_key}}"
                                                       name="setting_key[{{$setting->setting_key}}]"
                                                       value="{{$setting->setting_value}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if( (string)$setting->setting_key === 'ADDRESS_1' || (string)$setting->setting_key === 'ADDRESS_2')
                                    <div class="row mb-3">
                                        <div class="col-md-2 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <textarea class="form-control"
                                                          id="{{$setting->setting_key}}"
                                                          name="setting_key[{{$setting->setting_key}}]">{{$setting->setting_value}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if((string)$setting->setting_key === 'COUNTRY' || (string)$setting->setting_key === 'STATE' || (string)$setting->setting_key === 'CITY')
                                    <div class="row mb-3">
                                        <div class="col-md-2 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       id="{{$setting->setting_key}}"
                                                       name="setting_key[{{$setting->setting_key}}]"
                                                       value="{{$setting->setting_value}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-dark" type="submit">Submit</button>

                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="social_media_setting" role="tabpanel"
                         aria-labelledby="social-media-setting-tab">
                        <form id="social_media_form" class="form" action="#">
                            <div class="row mb-2 mt-2">
                                <div class="chart-heading">
                                    <h3>Social Media Setting</h3>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'FACEBOOK_LINK' || (string)$setting->setting_key === 'INSTAGRAM_LINK' || (string)$setting->setting_key === 'TWITTER_LINK' || (string)$setting->setting_key === 'PINTEREST_LINK' || (string)$setting->setting_key === 'DRIBBLE_LINK')
                                    <div class="row mb-3">
                                        <div class="col-md-2 text-md-start">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       id="{{$setting->setting_key}}"
                                                       name="setting_key[{{$setting->setting_key}}]"
                                                       value="{{$setting->setting_value}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-dark" type="submit">Submit</button>

                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="holiday_setting" role="tabpanel"
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
                                    {{-- Existing holiday fields --}}
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

                                        <div class="col-md-2 text-md-start mt-3">
                                            <label for="holiday_date_1" class="form-label"><span
                                                    class="required">Holiday Date</span></label>
                                        </div>
                                        <div class="col-md-3 d-flex mt-3">
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
        var general_form_url = '/general-setting-store';
        var email_setting_form_url = '/email-setting-store';
        var contact_info_form_url = '/contact-info-store';
        var social_media_form_url = '/social-media-store';
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
    <script src="{{URL::asset('assets/admin/custom/setting.js')}}?v={{ time() }}"></script>
@endsection
