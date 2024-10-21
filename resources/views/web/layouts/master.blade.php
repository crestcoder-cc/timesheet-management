<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        use Carbon\Carbon;$title = DB::table('settings')->where('setting_key','SITE_TITLE')->first()->setting_value;
        $logo = DB::table('settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        $favicon = DB::table('settings')->where('setting_key','FAVICON_IMG')->first()->setting_value;
    @endphp
    <title>{{$title}} - @yield('title')</title>
    <link rel="icon" href="{{ asset($favicon)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{  asset($favicon)}}"
          type="image/x-icon">
    @include('web.layouts.css')
    <style>

    </style>
</head>
<body>
<div class="container-fluid">
    @include('web.layouts.header')
    @yield('content')
</div>

<div id="add_task_model" class="modal modal-lg fade" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" data-parsley-validate="" id="taskModalForm" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-container">
                        @php
                            $company_id = Auth::user()->company_id;
                            $projects = DB::table('projects')->where('company_id',$company_id)->where('status','active')->get();
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control" name="client_id" id="client_id"
                                            data-popper-placement="Client">
                                        <option value="">Select Client</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                    {{--                                <input type="text" class="form-control" id="task" placeholder="Task">--}}
                                    <label for="task">Client</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="project" name="project"
                                           placeholder="Project">
                                    <label for="project">Project</label>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description" name="description" id="description"
                                  style="height: 100px;"></textarea>
                                    <label for="description">Description/Task</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                                    <label for="date">Date</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" name="start_time" id="start-time"
                                           placeholder="Start Time">
                                    <label for="start-time">Start Time</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" name="end_time" id="end-time"
                                           placeholder="End Time">
                                    <label for="end-time">End Time</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-control" name="location" id="location"
                                            data-popper-placement="Location">
                                        <option value="">Select Location</option>
                                        <option value="Work From Home">Work From Home</option>
                                        <option value="Work From Office">Work From Office</option>
                                    </select>

                                    <label for="location">Location</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="mark_absent_model" class="modal fade" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Absent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" data-parsley-validate="" id="markAbsentModalForm" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="absent_date" id="absent_date"
                                           placeholder="Absent Date" required>
                                    <label for="date">Mark Absent Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="update_task_model" class="modal modal-lg fade" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="update_task_render">

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
    $holiday = DB::table('holidays')
                 ->where('company_id', Auth::user()->company_id)
                 ->pluck('date')
                 ->toArray();
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
// Loop until you find a valid task date
while (in_array($task_date->format('Y-m-d'), $disabledDates) || $task_date->isWeekend()) {
    $task_date->addDay(); // Skip to the next day if it's a holiday, absent date, or weekend
}
 $task_date = $task_date->format('Y-m-d');
 $minDate = \Carbon\Carbon::parse(Auth::user()->registration_date)->format('Y-m-d');
 $absent_disable_date = DB::table('employee_tasks')
                            ->where('employee_id',Auth::user()->id)
                            ->distinct()
                            ->pluck('date')
                            ->toArray();
@endphp
@include('web.layouts.script')
<script>
    var absent_disable_date = @json($absent_disable_date); // Pass the PHP array to JavaScript
    var minDate = "{{$minDate}}";
    var allowedDate = "{{$task_date}}";
    document.addEventListener('DOMContentLoaded', function () {
        let dateInput = document.getElementById('absent_date');

        // Set the min attribute to the minimum date
        dateInput.setAttribute('min', minDate);

        // Set the initial value to the allowedDate if provided
        if (allowedDate) {
            dateInput.value = allowedDate; // Correctly set the initial value
        }

        // Disable all dates except those in the absent_disable_date array
        dateInput.addEventListener('change', function () {
            let selectedDate = this.value;

            // Check if the selected date is in the absent_disable_date array
            if (absent_disable_date.includes(selectedDate)) {
                this.setCustomValidity("You have already added task for this date. So you can't mark absent for this date. ");
                alert("You have already added task for this date. So you can't mark absent for this date. ");
                this.value = allowedDate || absent_disable_date[0]; // Reset to allowedDate or the first allowed date
            } else {
                this.setCustomValidity(""); // Clear any custom validity messages
            }
        });

        // Set the initial value to the first available date in absent_disable_date array if allowedDate is not provided
        if (!allowedDate && absent_disable_date.length > 0) {
            dateInput.value = absent_disable_date[0]; // Set the value to the first allowed date
            dateInput.setCustomValidity(""); // Clear any previous validation messages
        }
    });


    var disabledDates = <?php echo json_encode($disabledDates) ?>;
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
</body>
</html>
