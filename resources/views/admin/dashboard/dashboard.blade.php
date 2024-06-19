@extends('admin.layouts.master')
@section('title','Dashboard')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style>
    .disabled {
        background-color: #f0ad4e !important;
        color: #ffffff;
    }
</style>
@section('content')
    <div class="row">
        <div class="row g-1 g-xl-8">
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">{{$companies_count}}</div>
                        <div
                            class="text-dark fw-bolder fs-5">Total Companies
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">{{$employee_count}}</div>
                        <div
                            class="text-dark fw-bolder fs-5">Total Employees
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">150</div>
                        <div class="text-dark fw-bolder fs-5">Total Work Hours
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('admin.company.index')}}"
                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="text-dark fw-bolder fs-1">150</div>
                        <div
                            class="text-dark fw-bolder fs-5">Overtime Hours
                        </div>
                    </div>
                </a>
            </div>
            {{--            <div class="col-xl-3">--}}
            {{--                <a href="{{ route('admin.company.index')}}"--}}
            {{--                   class="card bg-white card-dash hoverable card-xl-stretch mb-xl-8">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <div class="text-dark fw-bolder fs-1">{{$holiday_count}}</div>--}}
            {{--                        <div--}}
            {{--                            class="text-dark fw-bolder fs-5">Total Holiday--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--            </div>--}}
        </div>
    </div>

    <div class="row mt-5 bg-white">
        <div class="col-6">
            <h3 class="mb-2 mt-2">Holidays List</h3>
            @if(empty($holidays))
                <div class="alert alert-info" role="alert">
                    No holidays have been set yet.
                </div>
            @else
                <table class="table table-borderless">
                    <thead class="text-white" style="background-color: #0071B2">
                    <tr>
                        <th>Holiday Title</th>
                        <th>Holiday Date</th>
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
        <div class="col-6">
            <h3 class="mb-2 mt-2">Holiday Calendar</h3>
            <div id="calendar"></div>
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <a href="{{ route('admin.setting.index') }}" class="btn btn-primary w-auto mt-3">Manage Holidays</a>
    </div>
@endsection
@section('custom-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var holidays = @json($holidays);

            // Initialize Bootstrap Datepicker
            $('#calendar').datepicker({
                // daysOfWeekDisabled: [0, 6], // Disable weekends
                todayHighlight: true, // Highlight today's date
                datesDisabled: holidays.map(holiday => new Date(holiday.date)), // Mark holiday dates
                format: 'yyyy-mm-dd', // Set the date format
                beforeShowDay: function(date) {
                    var dateString = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate(); // Adjust month to 1-based index
                    var holiday = holidays.find(h => h.date === dateString);
                    if (holiday) {
                        return {
                            tooltip: holiday.title
                        };
                    } else {
                        return {};
                    }
                }

            });
            $(document).on('mouseenter', '.disabled', function() {
                var date = $(this).attr('data-date');
                var holiday = holidays.find(h => h.date === date);
                if (holiday) {
                    $(this).attr('title', holiday.title).tooltip('show');
                }
            });
            $('#calendar .datepicker').css('width', '100%');
        });
    </script>
@endsection
