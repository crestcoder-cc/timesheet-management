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

    .table-details {
        display: none;
    }

    .btn-show-details {
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
                <div class="dash-counter">
                    <span>Total Employees</span>
                    <h3>{{$employee_count}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter gray">
                    <span>Total Hours</span>
                    <h3>150</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter gray">
                    <span>Total Work Hours</span>
                    <h3>150</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dash-counter">
                    <span>Overtime Hours</span>
                    <h3>70</h3>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="chart-heading">
                <h3>Company Employee Wise Task List</h3>
            </div>
            <div class="col-md-12">
                <table class="table table-borderless">
                    <thead class="dash-counter gray">
                    <tr class="text-white fs-5">
                        <th>Employee</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td class="toggle-icon"><a href="#">{{$employee->first_name .' '.$employee->last_name}}</a>
                            </td>
                        </tr>

                        <tr class="table-details">
                            <td colspan="6">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $employee_tasks = DB::table('employee_tasks')->where('employee_id',$employee->id)->get();
                                    @endphp
                                    @if($employee_tasks->count() > 0)
                                        @foreach($employee_tasks as $employee_task)
                                            <tr>
                                                <td>{{$employee_task->project}}</td>
                                                <td>{{$employee_task->description}}</td>
                                                <td>{{Carbon\Carbon::parse($employee_task->date)->format('d-m-Y')}}</td>
                                                <td>{{\Carbon\Carbon::parse($employee_task->start_time)->format('H:i A')}}</td>
                                                <td>{{\Carbon\Carbon::parse($employee_task->end_time)->format('H:i A')}}</td>
                                                <td>
                                                    @if($employee_task->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($employee_task->status == 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-danger">Reject</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($employee_task->status == 'pending')
                                                        <button type="button" title="Approve"
                                                                class="btn btn-success btn-sm task-status-change"
                                                                data-id="{{$employee_task->id}}" data-status="approved">
                                                            ✓
                                                        </button>
                                                        <button type="button" title="Reject"
                                                                class="btn btn-danger btn-sm reject-status"
                                                                data-id="{{$employee_task->id}}" data-status="reject">
                                                            ×
                                                        </button>
                                                    @elseif($employee_task->status == 'approved')
                                                        <button type="button"
                                                                title="Reject"
                                                                class="btn btn-danger btn-sm reject-status"
                                                                data-id="{{$employee_task->id}}" data-status="reject">
                                                            ×
                                                        </button>
                                                    @elseif($employee_task->status == 'reject')
                                                        <button type="button"
                                                                title="Approve"
                                                                class="btn btn-success btn-sm task-status-change"
                                                                data-id="{{$employee_task->id}}" data-status="approved">
                                                            ✓
                                                        </button>
                                                    @elseif($employee_task->status == 'resubmit')
                                                        <button type="button"
                                                                title="Approve"
                                                                class="btn btn-success btn-sm task-status-change"
                                                                data-id="{{$employee_task->id}}" data-status="approved">
                                                            ✓
                                                        </button>
                                                        <button type="button"
                                                                title="Reject"
                                                                class="btn btn-danger btn-sm reject-status"
                                                                data-id="{{$employee_task->id}}" data-status="reject">
                                                            ×
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Not Any Task</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="chart-heading">
                    <h3>Holidays List</h3>
                </div>
                @if(empty($holidays))
                    <div class="alert alert-info" role="alert">
                        No holidays have been set yet.
                    </div>
                @else
                    <table class="table table-striped nowrap" style="width:100%">
                        <thead>
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
            <div class="col-md-4">
                <div class="hotspot">
                    <h3 class="mb-2 mt-2">Holiday Calendar</h3>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
    <div class="modal" id="reject_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Task</h5>
                    <button type="button" class="close" id="close_reject_modal" data-dismiss="modal" aria-label="Close">
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
                                <input type="text" id="reject_reason" name="reject_reason" placeholder="Reject Reason"
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
            let formData = new FormData($rejectStatusForm[ 0 ])
            axios
                .post(APP_URL + '/reject-reason', formData)
                .then(function (response) {
                    $rejectStatusForm[ 0 ].reset()
                    $('#reject_modal').modal('hide');
                    loaderHide()
                    notificationToast(response.data.message, 'success')
                    window.location.reload()
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        })
    </script>
@endsection
