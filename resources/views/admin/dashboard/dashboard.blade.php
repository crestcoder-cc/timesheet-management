@extends('admin.layouts.master')
@section('title')
    Dashboard
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style>
    .datepicker table tr td, .datepicker table tr th {
        padding: 12px; /* Adjust the padding value as needed */
    }

    .disabled {
        background-color: #f0ad4e !important;
        color: #ffffff;
    }
</style>
@section('header')
    <div class="col-md-6">
        <div class="breadcrumb">
            <span>Dashboards</span>

        </div>
    </div>
@endsection
@section('content')

    <div class="container-fluid">
        {{--        <div class="row">--}}
        {{--            <div class="col-md-12">--}}
        {{--                <div class="filter-date">--}}
        {{--                    <select class="form-select">--}}
        {{--                        <option>Today</option>--}}
        {{--                        <option>Yesterday</option>--}}
        {{--                        <option>Last week</option>--}}
        {{--                        <option>Last Month</option>--}}
        {{--                        <option>Last Year</option>--}}
        {{--                    </select>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-3">
                <div class="dash-counter gray">
                    <span>Total Companies</span>
                    <h3>{{$companies_count}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter">
                    <span>Total Employees</span>
                    <h3>{{$employee_count}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter gray">
                    <span>Approved Work Hours</span>
                    <h3>{{$task_approved_hours}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter">
                    <span>Approved Overtime Hours</span>
                    <h3>{{$overtimeFormatted}}</h3>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="chart-heading">
                    <h3>Holidays of current month</h3>
                </div>
                @if(count($holidays) == 0)
                    <div class="alert alert-info" role="alert">
                        No holidays have been set yet.
                    </div>
                @else
                    <table class="table table-striped nowrap holidaytbl" style="width:100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($holidays as $holiday)
                            <tr>
                                <td>{{ $holiday->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($holiday->date)->format('F j, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="col-md-6 text-center">
                <div class="chart-heading">
                    <h3>Holiday Calender</h3>
                </div>
                <div class="hotspot calenderview">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
@endsection
@section('custom-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var holidays = @json($calender_mark_holiday);

            // Initialize Bootstrap Datepicker
            $('#calendar').datepicker({
                // daysOfWeekDisabled: [0, 6], // Disable weekends
                todayHighlight: true, // Highlight today's date
                datesDisabled: holidays.map(holiday => new Date(holiday.date)), // Mark holiday dates
                format: 'yyyy-mm-dd', // Set the date format
                beforeShowDay: function (date) {
                    var dateString = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
                    var holiday = holidays.find(h => h.date === dateString);
                    if (holiday) {
                        return {
                            classes: 'disabled',
                            tooltip: holiday.title
                        };
                    } else {
                        return {};
                    }
                }

            });
            $(document).on('mouseenter', '.disabled', function () {
                var date = $(this).data('date');
                var holiday = holidays.find(h => h.date === date);
                if (holiday) {
                    $(this).attr('title', holiday.title).tooltip('show');
                }
            });
        });
    </script>
@endsection
