@extends('company.layouts.master')
@section('title')
    Dashboard
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style>
    .datepicker table tr td, .datepicker table tr th {
        padding: 10px; /* Adjust the padding value as needed */
    }

    .disabled {
        background-color: #f0ad4e !important;
        color: #ffffff;
    }

    /*.table-details {*/
    /*    display: none;*/
    /*}*/

    .btn-show-details {
        cursor: pointer;
    }

    .employee-row {
        cursor: pointer;
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

    <div class="container-fluid" id="dashboard_part">
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
                <div class="dash-counter">
                    <span>Total Employees</span>
                    <h3>{{$employee_count}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter gray">
                    <span>Total Submitted Hours</span>
                    <h3 id="pending_hour_count">{{$task_pending_hours}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter gray">
                    <span>Total Approved Hours</span>
                    <h3 id="approve_hour_count">{{$task_approved_hours}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter">
                    <span>Approved Overtime Hours</span>
                    <h3 id="overtime_hour_count">{{$overtimeFormatted}}</h3>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row mt-3">
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
                    <h3>Holiday Calendar</h3>
                </div>
                <div class="hotspot calenderview">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="container mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="chart-heading">
                            <h3>Employee Task Detail</h3>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary" type="button" id="filter">Filter</button>
                    </div>
                </div>
            </div>
            <div class="container mb-2 d-none" id="filter_row">
                <div class="row">
                    <div class="col-md-3">
                        <label for="kt_daterangepicker_4">Select User</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name .' '.$user->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="date_range">Select Duration</label>
                        <input class="form-control form-control-solid" placeholder="Pick date range"
                               id="date_range" name="date_range"/>
                    </div>
                    <div class="col-md-3">
                        <label for="status">Select Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="all">All</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="reject">Reject</option>
                        </select>
                    </div>

                    <div class="col-md-1 mt-4">
                        <button class="btn btn-primary" type="button" id="search_submit">Search</button>
                    </div>
                    <div class="col-md-1 mt-4">
                        <button class="btn btn-primary" type="button" id="clear" disabled><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-md-1 mt-4">
                        <button class="btn btn-primary" type="button" id="download_report" disabled>Report
                        </button>
                    </div>
                </div>
            </div>


            <div class="col-md-12" id="search_part">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="dash-counter gray">
                        <tr>
                            <th>Employee</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->mobile_no }}</td>
                                <td class="employee-row toggle-icon" data-id="{{ $employee->id }}">
                                    <i class="fa-solid fa-caret-down"></i>
                                </td>
                            </tr>

                            <tr class="table-details ">
                                <td colspan="4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-responsive">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Project</th>
                                                {{--                                                <th>Description</th>--}}
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Total Hours</th>
                                                <th>OT Hours</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $employee_tasks = DB::table('employee_tasks')->where('employee_id', $employee->id)->get();
                                            @endphp
                                            @if($employee_tasks->count() > 0)
                                                @foreach($employee_tasks as $employee_task)
                                                    <tr>
                                                        <td>{{ $employee_task->project }}</td>
                                                        {{-- <td>{{ $employee_task->description }}</td> --}}
                                                        <td>{{ \Carbon\Carbon::parse($employee_task->date)->format('d-m-Y') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($employee_task->start_time)->format('h:i A') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($employee_task->end_time)->format('h:i A') }}</td>
                                                        @php
                                                            // Calculate total working hours for the current task
                                                            $start_time = \Carbon\Carbon::parse($employee_task->start_time);
                                                            $end_time = \Carbon\Carbon::parse($employee_task->end_time);
                                                            $total_duration = $end_time->diff($start_time);
                                                            $hours = $total_duration->h;
                                                            $minutes = $total_duration->i;

                                                            // Format the total duration in HH:mm format
                                                            $total_rhours  = sprintf('%02d:%02d', $hours, $minutes);

                                                            // Get all tasks for the employee on the same date to calculate the total working time
                                                            $overtime_record = DB::table('employee_tasks')
                                                                ->where('employee_id', $employee->id)
                                                                ->where('date', $employee_task->date)
                                                                ->whereIn('status', ['approved', 'pending']) // Only consider approved or pending tasks
                                                                ->get();

                                                            $total_hours = 0;
                                                            $total_minutes = 0;
                                                            $pending = true; // Check if any task is still pending for approval

                                                            foreach ($overtime_record as $task) {
                                                                if ($task->status == 'approved') {
                                                                    $pending = false;
                                                                }
                                                                $start_time = \Carbon\Carbon::parse($task->start_time);
                                                                $end_time = \Carbon\Carbon::parse($task->end_time);

                                                                $task_duration = $end_time->diff($start_time);
                                                                $total_hours += $task_duration->h;
                                                                $total_minutes += $task_duration->i;
                                                            }

                                                            // Convert total minutes to hours
                                                            $total_hours += intdiv($total_minutes, 60);
                                                            $total_minutes = $total_minutes % 60;

                                                            // Format the total working time in HH:mm format
                                                            $total_time_formatted  = sprintf('%02d:%02d', $total_hours, $total_minutes);

                                                            // Calculate overtime: anything beyond 480 minutes (8 hours)
                                                            $total_worked_minutes = ($total_hours * 60) + $total_minutes;
                                                            $overtime_minutes = max(0, $total_worked_minutes - 480);

                                                            $overtime_hours = intdiv($overtime_minutes, 60);
                                                            $overtime_remainder_minutes = $overtime_minutes % 60;

                                                            // Format the overtime in HH:mm format
                                                            $overtime_time_formatted = sprintf('%02d:%02d', $overtime_hours, $overtime_remainder_minutes);
                                                        @endphp
                                                        <td>{{ $total_rhours }} </td>
                                                        @if($employee_task->status === 'reject')
                                                            <td>-</td>
                                                        @else
                                                            <td>{{ $overtime_time_formatted == '00:00' ? '-' : $overtime_time_formatted }}</td>
                                                        @endif
                                                        <td>
                                                            @if($employee_task->status == 'pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @elseif($employee_task->status == 'approved')
                                                                <span class="badge bg-success">Approved</span>
                                                            @else
                                                                <span class="badge bg-danger">Rejected</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($employee_task->status == 'pending')
                                                                <button type="button" title="Approve"
                                                                        class="btn btn-success btn-sm task-status-change"
                                                                        data-id="{{ $employee_task->id }}"
                                                                        data-status="approved">✓
                                                                </button>
                                                                <button type="button" title="Reject"
                                                                        class="btn btn-danger btn-sm reject-status"
                                                                        data-id="{{ $employee_task->id }}"
                                                                        data-status="reject">×
                                                                </button>
                                                            @elseif($employee_task->status == 'approved')
                                                                <button type="button" title="Reject"
                                                                        class="btn btn-danger btn-sm reject-status"
                                                                        data-id="{{ $employee_task->id }}"
                                                                        data-status="reject">×
                                                                </button>
                                                            @elseif($employee_task->status == 'rejected')
                                                                <button type="button" title="Approve"
                                                                        class="btn btn-success btn-sm task-status-change"
                                                                        data-id="{{ $employee_task->id }}"
                                                                        data-status="approved">✓
                                                                </button>
                                                            @elseif($employee_task->status == 'resubmit')
                                                                <button type="button" title="Approve"
                                                                        class="btn btn-success btn-sm task-status-change"
                                                                        data-id="{{ $employee_task->id }}"
                                                                        data-status="approved">✓
                                                                </button>
                                                                <button type="button" title="Reject"
                                                                        class="btn btn-danger btn-sm reject-status"
                                                                        data-id="{{ $employee_task->id }}"
                                                                        data-status="reject">×
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center">Task Not Found</td>
                                                </tr>
                                            @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="modal" id="reject_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Task</h5>
                    <button type="button" class="close" id="close_reject_modal" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" data-parsley-validate="" id="rejectStatusForm" role="form">
                        @csrf
                        <input type="hidden" id="task_id" name="task_id">
                        <input type="hidden" id="task_status" name="task_status">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="reject_reason" name="reject_reason"
                                       placeholder="Reject Reason"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 text-center">
                            <button class="btn btn-dark" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var holidays = @json($calender_mark_holiday);
            $('#calendar').datepicker({
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
    <script>
        $(document).ready(function () {
            $('.toggle-icon').click(function () {
                var $detailsRow = $(this).closest('tr').next('.table-details');
                $detailsRow.toggle();
                var $icon = $(this).find('i');

                // Toggle between the down and up icons
                if ($icon.hasClass('fa-caret-down')) {
                    $icon.removeClass('fa-caret-down').addClass('fa-caret-up');
                } else {
                    $icon.removeClass('fa-caret-up').addClass('fa-caret-down');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.task-status-change', function () {
            const value_id = $(this).data('id')
            const status = $(this).data('status')
            Swal.fire({
                title: 'Change Status ?',
                // text: sweetalert_change_status_text,
                icon: 'warning',
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: 'Yes Change It',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn fw-bold btn-danger',
                    cancelButton: 'btn fw-bold btn-active-light-primary'
                },
            }).then((function (t) {
                if (t.isConfirmed) {
                    changeStatus(value_id, status)
                }
            }))
        })

        function changeStatus(value_id, status) {
            loaderView()
            axios
                .get(APP_URL + '/task-status' + '/' + value_id + '/' + status)
                .then(function (response) {
                    notificationToast(response.data.message, 'success')
                    window.location.reload()
                    $('#dashboard_part').html(response.data.data)
                    loaderHide()
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        }

        $(document).on('click', '.reject-status', function () {
            const value_id = $(this).data('id')
            const status = $(this).data('status')
            $('#reject_modal').modal('show')
            $('#task_id').val(value_id)
            $('#task_status').val(status)
        });
        $(document).on('click', '#close_reject_modal', function () {
            $('#reject_modal').modal('hide')
        });
    </script>
    <script>
        let $rejectStatusForm = $('#rejectStatusForm')
        $rejectStatusForm.on('submit', function (e) {
            e.preventDefault()
            loaderView()
            let formData = new FormData($rejectStatusForm[0])
            axios
                .post(APP_URL + '/reject-reason', formData)
                .then(function (response) {
                    $rejectStatusForm[0].reset()
                    $('#reject_modal').modal('hide');
                    notificationToast(response.data.message, 'success')
                    window.location.reload();
                    $('#dashboard_part').html(response.data.data)
                    loaderHide()
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        })
        var start = moment().subtract(29, "days");
        var end = moment();

        // Function to update the input with the selected date range
        function updateInputWithDateRange(start, end) {
            $("#date_range").val(start.format("DD-MM-YYYY") + " To " + end.format("DD-MM-YYYY"));
        }

        // Initialize the date range picker
        $("#date_range").daterangepicker({
            autoUpdateInput: false, // Keeps the input empty by default
            startDate: start,
            endDate: end,
            // ranges: {
            //     "Today": [moment(), moment()],
            //     "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            //     "Last 7 Days": [moment().subtract(6, "days"), moment()],
            //     "Last 30 Days": [moment().subtract(29, "days"), moment()],
            //     "This Month": [moment().startOf("month"), moment().endOf("month")],
            //     "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            // }
        });

        $("#date_range").on('apply.daterangepicker', function (ev, picker) {
            updateInputWithDateRange(picker.startDate, picker.endDate);
        });

        $("#date_range").on('cancel.daterangepicker', function (ev, picker) {
            $("#date_range").val(''); // Clear the input value
        });


        $(document).on('click', '#search_submit', function () {
            var user_id = $('#user_id').val()
            var date_range = $('#date_range').val()
            var status = $('#status').val()
            loaderView()
            axios
                .post(APP_URL + '/search', {
                    user_id: user_id,
                    date_range: date_range,
                    status: status,
                })
                .then(function (response) {
                    // notificationToast(response.data.message, 'success')
                    // window.location.reload()
                    $('#search_part').html(response.data.data)
                    $('#download_report').prop('disabled', false)
                    $('#clear').prop('disabled', false)
                    $('#pending_hour_count').text(response.data.task_pending_hours)
                    $('#approve_hour_count').text(response.data.task_approved_hours)
                    $('#overtime_hour_count').text(response.data.overtimeFormatted)
                    loaderHide()
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        })

        $(document).on('click', '#clear', function () {
            $('#download_report').prop('disabled', true)
            $('#clear').prop('disabled', true)
            window.location.reload()
        })
        $('#download_report').on('click', function () {
            var user_id = $('#user_id').val()
            var date_range = $('#date_range').val()
            var status = $('#status').val()
            loaderView()
            axios
                .post(APP_URL + '/employeeReport', {
                    user_id: user_id,
                    date_range: date_range,
                    status: status,
                })
                .then(function (response) {
                    var link = document.createElement('a')
                    link.href = response.data.url
                    link.download = 'Employee Report.xlsx'
                    link.click()
                    link.remove()
                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })
        })

        $(document).on('click', '#filter', function () {
            $('#filter_row').toggleClass('d-none');
        });
    </script>
@endsection
