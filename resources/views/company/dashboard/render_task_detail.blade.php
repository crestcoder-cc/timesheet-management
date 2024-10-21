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
                                $employee_tasks = DB::table('employee_tasks')->where('employee_id', $employee->id);
                                [$startDate, $endDate] = explode(' To ', $date_range);
                                if($status != 'all'){
                                   $employee_tasks = $employee_tasks->where('status',$status);
                                }
                                $startDate = Carbon\Carbon::createFromFormat('d-m-Y', $startDate)->format('Y-m-d');
                                $endDate = Carbon\Carbon::createFromFormat('d-m-Y', $endDate)->format('Y-m-d');
                                $employee_tasks = $employee_tasks->whereBetween('date', [$startDate, $endDate])->get();
                            @endphp
                            @if($employee_tasks->count() > 0)
                                @foreach($employee_tasks as $employee_task)
                                    <tr>
                                        <td>{{ $employee_task->project }}</td>
                                        {{--                                                        <td>{{ $employee_task->description }}</td>--}}
                                        <td>{{ \Carbon\Carbon::parse($employee_task->date)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($employee_task->start_time)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($employee_task->end_time)->format('h:i A') }}</td>
                                        @php
                                            $start_time = \Carbon\Carbon::parse($employee_task->start_time);
                                            $end_time = \Carbon\Carbon::parse($employee_task->end_time);
                                            $total_duration = $end_time->diff($start_time);
                                            $hours = $total_duration->h;
                                            $minutes = $total_duration->i;
                                            $hours += intdiv($minutes, 60);
                                        $minutes = $minutes % 60;
                                        $total_rhours  = sprintf('%02d:%02d', $hours, $minutes);
                                        $overtime_record = DB::table('employee_tasks')
                                        ->where('date',$employee_task->date)
                                        ->where('employee_id', $employee->id)
                                        ->whereBetween('date', [$startDate, $endDate])
                                        ->get();
                                        $total_hours = 0;
                                        $total_minutes = 0;
                                        $pending = true;
                                        foreach ($overtime_record as $task) {
                                            if($task->status == 'approved'){
                                                $pending = false;
                                                $start_time = \Carbon\Carbon::parse($task->start_time);
                                                $end_time = \Carbon\Carbon::parse($task->end_time);

                                                $total_hours_duration = $end_time->diff($start_time);
                                                $total_hours += $total_hours_duration->h;
                                                $total_minutes += $total_hours_duration->i;
                                            }
                                        }
                                        if ($pending){
                                            foreach ($overtime_record as $task) {
                                            if($task->status == 'pending'){
                                                $start_time = \Carbon\Carbon::parse($task->start_time);
                                                $end_time = \Carbon\Carbon::parse($task->end_time);

                                                $total_hours_duration = $end_time->diff($start_time);
                                                $total_hours += $total_hours_duration->h;
                                                $total_minutes += $total_hours_duration->i;
                                                }
                                            }
                                        }
                                        $total_hours += intdiv($total_minutes, 60);
                                        $total_minutes = $total_minutes % 60;
                                        $total_time_formatted  = sprintf('%02d:%02d', $total_hours, $total_minutes);
                                        $overtime_minutes = max(0, ($total_hours * 60 + $total_minutes) - 480);
                                        $overtime_hours = intdiv($overtime_minutes, 60);
                                        $overtime_remainder_minutes = $overtime_minutes % 60;
                                        $overtime_time_formatted = sprintf('%02d:%02d', $overtime_hours, $overtime_remainder_minutes);
                                        @endphp
                                        <td>{{ $total_rhours }} </td>
                                        @if($employee_task->status === 'reject')
                                            <td>-</td>
                                        @else
                                            <td>{{$overtime_time_formatted == '00:00' ? '-' : $overtime_time_formatted}} </td>
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
    // $('#download_report').on('click', function () {
    //     var user_id = $('#user_id').val()
    //     var date_range = $('#date_range').val()
    //     var status = $('#status').val()
    //     axios
    //         .post(APP_URL + '/employeeReport', {
    //             user_id: user_id,
    //             date_range: date_range,
    //             status: status,
    //         })
    //         .then(function (response) {
    //             var link = document.createElement('a')
    //             link.href = response.data.url
    //             link.download = 'Employee Report.xlsx'
    //             link.click()
    //             link.remove()
    //             loaderHide()
    //         })
    //         .catch(function (error) {
    //             loaderHide()
    //         })
    // })
</script>
