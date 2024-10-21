@php use App\Models\EmployeeTask;use Carbon\Carbon;use Illuminate\Support\Facades\Auth; @endphp
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped" id="table">
            <tbody>
            @foreach($dateArrays as $key => $date)
                @php
                    $employee_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date', $date)->get();
                    $task_pending_count = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date', $date)->where('status', 'pending')->count();
                    $task_reject_count = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date', $date)->where('status', 'reject')->count();

                    $submitted_hours = 0;
                    $approved_hours = 0;
                    $rejected_hours = 0;
                    $submitted_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date', $date)->where('status', 'pending')->get();
                    $approved_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date', $date)->where('status', 'approved')->get();
                    $rejected_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date', $date)->where('status', 'reject')->get();

                    foreach ($submitted_tasks as $submitted_task) {
                        $startTime = Carbon::parse($submitted_task->start_time);
                        $endTime = Carbon::parse($submitted_task->end_time);
                        $submitted_hours += $endTime->diffInHours($startTime);
                    }

                    foreach ($approved_tasks as $approved_task) {
                        $startTime = Carbon::parse($approved_task->start_time);
                        $endTime = Carbon::parse($approved_task->end_time);
                        $approved_hours += $endTime->diffInHours($startTime);
                    }

                    foreach ($rejected_tasks as $rejected_task) {
                        $startTime = Carbon::parse($rejected_task->start_time);
                        $endTime = Carbon::parse($rejected_task->end_time);
                        $rejected_hours += $endTime->diffInHours($startTime);
                    }

                    $tr_bg = 'custom-need-to-submit';
                    if($employee_tasks->count() > 0) {
                        if ($task_reject_count > 0) {
                            $tr_bg = 'custom-reject';
                        } else if ($task_pending_count > 0) {
                            $tr_bg = 'custom-submitted';
                        } else {
                            $tr_bg = 'custom-approved';
                        }
                    }
                    $ot_bg = '';
                  $fside_overtime_record = DB::table('employee_tasks')->where('date', $date)->where('employee_id',Auth::user()->id)->get();
                                            $fside_total_hours = 0;
                                            $fside_total_minutes = 0;
                                            $pending = true;
                                            foreach ($fside_overtime_record as $fside_task) {
                                                if($fside_task->status == 'approved'){
                                                     $pending = false;
                                                     $fside_start_time = Carbon::parse($fside_task->start_time);
                                                $fside_end_time = Carbon::parse($fside_task->end_time);
                                                $fside_total_hours_duration = $fside_end_time->diff($fside_start_time);
                                                $fside_total_hours += $fside_total_hours_duration->h;
                                                $fside_total_minutes += $fside_total_hours_duration->i;
                                                }

                                            }
                                            if ($pending){
                                                 foreach ($fside_overtime_record as $fside_task) {
                                                if($fside_task->status == 'pending'){
                                                     $fside_start_time = Carbon::parse($fside_task->start_time);
                                                $fside_end_time = Carbon::parse($fside_task->end_time);
                                                $fside_total_hours_duration = $fside_end_time->diff($fside_start_time);
                                                $fside_total_hours += $fside_total_hours_duration->h;
                                                $fside_total_minutes += $fside_total_hours_duration->i;
                                                }

                                            }
                                            }
                                            $fside_total_hours += intdiv($fside_total_minutes, 60);
                                            $fside_total_minutes = $fside_total_minutes % 60;
                                            $fside_total_time_formatted = sprintf('%02d:%02d', $fside_total_hours, $fside_total_minutes);

                                            $fside_overtime_minutes = max(0, ($fside_total_hours * 60 + $fside_total_minutes) - 480);
                                            $fside_overtime_hours = intdiv($fside_overtime_minutes, 60);
                                            $fside_overtime_remainder_minutes = $fside_overtime_minutes % 60;
                                            $fside_overtime_time_formatted = sprintf('%02d:%02d', $fside_overtime_hours, $fside_overtime_remainder_minutes);
                                            if ($fside_overtime_time_formatted != '00:00'){
                                                $ot_bg = 'ot-bg';
                                            }
                @endphp

                <tr class="{{$tr_bg}} {{$ot_bg}}">
                    <td class="{{$tr_bg}} {{$ot_bg}}">{{ Carbon::parse($date)->format('d-m-Y') }}
                        <br><strong>{{ $key }}</strong>
                    </td>
                    <td class="{{$tr_bg}} {{$ot_bg}}">Submitted Hours<br><strong>{{ $submitted_hours }}</strong></td>
                    <td class="{{$tr_bg}} {{$ot_bg}}">Approved Hours<br><strong>{{ $approved_hours }}</strong></td>
                    <td class="{{$tr_bg}} {{$ot_bg}}">Rejected Hours<br><strong>{{ $rejected_hours }}</strong></td>
                    <td class="{{$tr_bg}} {{$ot_bg}}">
                        Location<br><strong>{{ Auth::guard('web')->user()->location }}</strong></td>
                    <td class="{{$tr_bg}} {{$ot_bg}}">Status<br>
                        @if($employee_tasks->count() > 0)
                            @if($task_pending_count > 0)
                                @if($task_reject_count > 0)
                                    <strong
                                        class="status-present">Reject @if($fside_overtime_time_formatted != '00:00')
                                            <span class="badge text-bg-secondary">OT ({{$fside_overtime_time_formatted}})</span>
                                        @endif</strong>
                                @else
                                    <strong
                                        class="status-present">Submitted @if($fside_overtime_time_formatted != '00:00')
                                            <span
                                                class="badge text-bg-secondary">OT ({{$fside_overtime_time_formatted}})</span>
                                        @endif</strong>
                                @endif

                            @else
                                @if($task_reject_count > 0)
                                    <strong
                                        class="status-present">Reject @if($fside_overtime_time_formatted != '00:00')
                                            <span class="badge text-bg-secondary">OT ({{$fside_overtime_time_formatted}})</span>
                                        @endif</strong>
                                @else
                                    <strong
                                        class="status-present">Approved @if($fside_overtime_time_formatted != '00:00')
                                            <span
                                                class="badge text-bg-secondary">OT ({{$fside_overtime_time_formatted}})</span>
                                        @endif</strong>
                                @endif

                            @endif
                        @else
                            <strong class="status-present">Need To Submit</strong>
                        @endif
                    </td>
                    <td class="{{$tr_bg}} {{$ot_bg}}">
                        <span class="toggle-icon cursor-pointer">
                            <i class="fa-solid fa-caret-down"></i>
                        </span>
                    </td>
                </tr>

                <tr class="card table-details mb-3" style="display: none;">
                    <td colspan="8">
                        @if(count($employee_tasks) > 0)
                            <table class="text-start status-table">
                                <thead class="text-dark">
                                <tr>
                                    <th>Client</th>
                                    <th>Project</th>
                                    <th>Description</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Total Hours</th>
                                    {{--                                    <th>OT Hours</th>--}}
                                    <th>Location</th>
                                    <th>Approval</th>
                                </tr>
                                </thead>
                                <tbody class="task-detail">
                                @foreach($employee_tasks as $employee_task)
                                    <tr>
                                        <td>{{ $employee_task->client }}</td>
                                        <td>{{ $employee_task->project }}</td>
                                        <td>{{ $employee_task->description }}</td>
                                        <td>{{ Carbon::parse($employee_task->start_time)->format('h:i A') }}</td>
                                        <td>{{ Carbon::parse($employee_task->end_time)->format('h:i A') }}</td>
                                        @php
                                            $start_time = Carbon::parse($employee_task->start_time);
                                            $end_time = Carbon::parse($employee_task->end_time);
                                            $total_duration = $end_time->diff($start_time);
                                            $hours = $total_duration->h;
                                            $minutes = $total_duration->i;
                                            $hours += intdiv($minutes, 60);
                                            $minutes = $minutes % 60;
                                            $total_rhours = sprintf('%02d:%02d', $hours, $minutes);

                                            $overtime_record = DB::table('employee_tasks')->where('date', $employee_task->date)->where('employee_id',Auth::user()->id)->get();
                                            $total_hours = 0;
                                            $total_minutes = 0;
                                            $allPending = true;
                                            foreach ($overtime_record as $task) {
                                                  if ($task->status == 'approved') {
                                                    $allPending = false;
                                                    $start_time = Carbon::parse($task->start_time);
                                                    $end_time = Carbon::parse($task->end_time);
                                                    $total_hours_duration = $end_time->diff($start_time);
                                                    $total_hours += $total_hours_duration->h;
                                                    $total_minutes += $total_hours_duration->i;
                                                }
                                            }
                                            if ($allPending == true) {
                                                  foreach ($overtime_record as $task) {
                                                       if ($task->status == 'pending') {
                                                        $start_time = Carbon::parse($task->start_time);
                                                        $end_time = Carbon::parse($task->end_time);
                                                        $total_hours_duration = $end_time->diff($start_time);
                                                        $total_hours += $total_hours_duration->h;
                                                        $total_minutes += $total_hours_duration->i;
                                                    }
                                                }
                                             }
                                            $total_hours += intdiv($total_minutes, 60);
                                            $total_minutes = $total_minutes % 60;
                                            $total_time_formatted = sprintf('%02d:%02d', $total_hours, $total_minutes);

                                            $overtime_minutes = max(0, ($total_hours * 60 + $total_minutes) - 480);
                                            $overtime_hours = intdiv($overtime_minutes, 60);
                                            $overtime_remainder_minutes = $overtime_minutes % 60;
                                            $overtime_time_formatted = sprintf('%02d:%02d', $overtime_hours, $overtime_remainder_minutes);
                                        @endphp
                                        <td>{{ $total_rhours }}</td>
                                        {{--                                        <td>{{ $overtime_time_formatted }}</td>--}}
                                        <td>{{ $employee_task->location }}</td>
                                        <td>
                                            @if($employee_task->status == 'pending')
                                                <span class="badge text-bg-warning">Pending</span>
                                            @elseif($employee_task->status == 'approved')
                                                <span class="badge text-bg-success">Approved</span>
                                            @else
                                                <span class="badge text-bg-danger">Reject</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-dark text-center">No task found</p>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@php
    $last_record = DB::table('employee_tasks')
    ->where('employee_id', Auth::user()->id)
    ->latest('created_at')
    ->first();
$absent_dates = DB::table('absents')
    ->where('employee_id', Auth::user()->id)
    ->pluck('date')
    ->toArray();
if (!is_null($last_record)) {
    $task_date = \Carbon\Carbon::parse($last_record->date)->addDay(); // Start from the day after the last record's date
} else {
    $task_date = \Carbon\Carbon::parse(Auth::user()->registration_date);
}
if (Auth::user()->overtime_permission == 'no') {
    $holiday = DB::table('holidays')->where('company_id',Auth::user()->company_id)->pluck('date')->toArray();
$startDate = Auth::user()->registration_date; // Replace with your specific start date

$startDate = Carbon::parse($startDate);
$endDate = $startDate->copy()->addMonths(3);
$weekendDates = [];
while ($startDate->lte($endDate)) {
    if ($startDate->isSaturday() || $startDate->isSunday()) {
        $weekendDates[] = $startDate->format('Y-m-d'); // Add the weekend date to the array
    }
    $startDate->addDay(); // Move to the next day
}
} else {
    $holiday = [];
    $weekendDates = [];
}

$disabledDates = array_merge($holiday, $absent_dates,$weekendDates);
while (in_array($task_date->format('Y-m-d'), $disabledDates) || $task_date->isWeekend()) {
    $task_date->addDay(); // Skip to the next day if it's a holiday, absent date, or weekend
}
$task_date = $task_date->format('Y-m-d');
$minDate = \Carbon\Carbon::parse(Auth::user()->registration_date)->format('Y-m-d');
@endphp
<script>
    $(document).ready(function () {
        $('.toggle-icon').click(function () {
            let tableDetails = $(this).closest('tr').next('.table-details');
            let icon = $(this).find('i');
            if (tableDetails.hasClass('table-details')) {
                if (tableDetails.css('display') === 'none') {
                    tableDetails.css('display', 'table-row');
                    icon.removeClass('fa-caret-down').addClass('fa-caret-up');
                } else {
                    tableDetails.css('display', 'none');
                    icon.removeClass('fa-caret-up').addClass('fa-caret-down');
                }
            }
        });
    });
    $('#add_task').on('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('add_task_model'), {
            keyboard: false
        });
        myModal.show();
    });
    $('#mark_absent').on('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('mark_absent_model'), {
            keyboard: false
        });
        myModal.show();
    });
    $('#btn-close').on('click', function () {
        $('#add_task_model').modal('hide');
    });
    document.addEventListener('DOMContentLoaded', function () {
        let dateInput = document.getElementById('absent_date');
        let today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format
        dateInput.setAttribute('min', today); // Set the min attribute to today's date
    });
    var allowedDate = "{{$task_date}}";
    var minDate = "{{$minDate}}";
    var disabledDates = <?php echo json_encode($disabledDates); ?>;
    var dateInput = document.getElementById('date');
    dateInput.min = minDate;
    dateInput.max = allowedDate;
    dateInput.value = allowedDate;

    function isDateDisabled(date) {
        return disabledDates.includes(date);
    }

    // Disable specific dates
    dateInput.addEventListener('input', function () {
        if (isDateDisabled(this.value)) {
            this.setCustomValidity('It`s a holiday today! You are not allowed to submit the timesheet.');
        } else {
            this.setCustomValidity('');
        }
    });

    // Reset the value if a disabled date is selected
    dateInput.addEventListener('change', function () {
        if (isDateDisabled(this.value)) {
            this.value = ''; // Clear the input if the selected date is disabled
            alert('It`s a holiday today! You are not allowed to submit the timesheet.');
        }
    });

    // Disable pasting a disabled date
    dateInput.addEventListener('paste', function (e) {
        e.preventDefault();
    });

    // Add a class to visually disable the date if the browser supports CSS ::-webkit-datetime-edit
    function applyVisualDisable() {
        // This does not actually disable the date in the date picker UI but can add visual feedback
        disabledDates.forEach(date => {
            if (dateInput.type === 'date') {
                // Unfortunately, there's no direct way to visually disable dates with native date pickers
                // The user would still need to be informed via alert or custom validation as shown above.
                // One approach is to use a custom date picker library for full control.
            }
        });
    }

    // Call this function on page load to apply the visual disable if possible
    document.addEventListener('DOMContentLoaded', applyVisualDisable);
</script>
