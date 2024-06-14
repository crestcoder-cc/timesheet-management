@extends('admin.layouts.master')
@section('title','Settings')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Settings</h4>
            </div>
        </div>
    </div>

    <div class="container mt-4">
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
                            <div class="row mb-3">
                                <div class="col-md-9 offset-md-3">
                                    <h2>General</h2>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'LOGO_IMG' || (string)$setting->setting_key === 'FAVICON_IMG')
                                    <div class="row mb-3">
                                        <div class="col-md-3 text-md-end">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label">  {{str_replace('_',' ',$setting->setting_key)}}</label>
                                        </div>
                                        <div class="col-md-9">
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
                                        <div class="col-md-3 text-md-end">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label">{{str_replace('_',' ',$setting->setting_key)}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                   name="setting_key[{{$setting->setting_key}}]"
                                                   id="{{$setting->setting_key}}" value="{{$setting->setting_value}}"/>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary me-3" type="submit">Submit</button>
                                <a href="#">
                                    <button class="btn btn-secondary" type="button">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="email_setting" role="tabpanel"
                         aria-labelledby="email-setting-tab">
                        <form id="email_setting_form" class="form" action="#">
                            <div class="row mb-3">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Email Setting</h2>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'SMTP_HOST' || (string)$setting->setting_key === 'SMTP_PORT' || (string)$setting->setting_key === 'SMTP_USERNAME'
                                      || (string)$setting->setting_key === 'SMTP_PASSWORD' || (string)$setting->setting_key === 'FROM_EMAIL' || (string)$setting->setting_key === 'FROM_EMAIL_TITLE')
                                    <div class="row mb-3">
                                        <div class="col-md-3 text-md-end">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
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
                                        <div class="col-md-3 text-md-end">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>

                                        <div class="col-md-9">
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
                                <button class="btn btn-primary me-3" type="submit">Submit</button>
                                <a href="#">
                                    <button class="btn btn-secondary" type="button">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="contact_info" role="tabpanel"
                         aria-labelledby="contact-setting-tab">
                        <form id="contact_info_form" class="form" action="#">
                            <div class="row mb-3">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Contact Info Setting</h2>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'CONTACT_NUMBER_1' || (string)$setting->setting_key === 'CONTACT_NUMBER_2' || (string)$setting->setting_key === 'WHATSAPP_NUMBER' || (string)$setting->setting_key === 'ZIPCODE')
                                    <div class="row mb-3">
                                        <div class="col-md-3 text-md-end">
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
                                        <div class="col-md-3 text-md-end">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <textarea class="form-control integer"
                                                          id="{{$setting->setting_key}}"
                                                          name="setting_key[{{$setting->setting_key}}]">
                                                       {{$setting->setting_value}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if((string)$setting->setting_key === 'COUNTRY' || (string)$setting->setting_key === 'STATE' || (string)$setting->setting_key === 'CITY')
                                    <div class="row mb-3">
                                        <div class="col-md-3 text-md-end">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
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
                                <button class="btn btn-primary me-3" type="submit">Submit</button>
                                <a href="#">
                                    <button class="btn btn-secondary" type="button">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="social_media_setting" role="tabpanel"
                         aria-labelledby="social-media-setting-tab">
                        <form id="social_media_form" class="form" action="#">
                            <div class="row mb-3">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Social Media Setting</h2>
                                </div>
                            </div>
                            @foreach($settings as $setting)
                                @if((string)$setting->setting_key === 'FACEBOOK_LINK' || (string)$setting->setting_key === 'INSTAGRAM_LINK' || (string)$setting->setting_key === 'TWITTER_LINK' || (string)$setting->setting_key === 'PINTEREST_LINK' || (string)$setting->setting_key === 'DRIBBLE_LINK')
                                    <div class="row mb-3">
                                        <div class="col-md-3 text-md-end">
                                            <label for="{{$setting->setting_key}}"
                                                   class="form-label"><span
                                                    class="required"> {{str_replace('_',' ',$setting->setting_key)}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-9">
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
                                <button class="btn btn-primary me-3" type="submit">Submit</button>
                                <a href="#">
                                    <button class="btn btn-secondary" type="button">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="holiday_setting" role="tabpanel"
                         aria-labelledby="holiday-setting-tab">
                        <form id="holiday_form" class="form" action="#">
                            <div class="row mb-3">
                                <div class="col-md-9 offset-md-3">
                                    <h2>Holiday Setting</h2>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3 text-md-end">
                                    <label for="holiday"
                                           class="form-label"><span
                                            class="required"> Holiday Date</span>
                                    </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="holiday-picker" class="form-control" placeholder="Select multiple dates">
                                    <div id="holidays-inputs"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary me-3" type="submit">Submit</button>
                                <a href="#">
                                    <button class="btn btn-secondary" type="button">Cancel</button>
                                </a>
                            </div>
                        </form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const existingDates = @json($holidays);

            flatpickr("#holiday-picker", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                defaultDate: existingDates,
                onChange: function(selectedDates, dateStr, instance) {
                    const holidaysInputsDiv = document.getElementById('holidays-inputs');
                    holidaysInputsDiv.innerHTML = ''; // Clear previous inputs
                    selectedDates.forEach(date => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'holidays[]';
                        input.value = instance.formatDate(date, 'Y-m-d');
                        holidaysInputsDiv.appendChild(input);
                    });
                }
            });

            // Trigger the onChange to populate the initial inputs
            document.querySelector("#holiday-picker")._flatpickr.config.onChange();
        });
    </script>
    <script src="{{URL::asset('assets/custom-js/admin/setting.js')}}?v={{ time() }}"></script>
@endsection
