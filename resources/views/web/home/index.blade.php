@php use App\Models\EmployeeTask; @endphp
@extends('web.layouts.master')
@section('title')
    Home
@endsection
@section('content')
    <div class="emp-dashboard" id="emp-dashboard">
        <div class="date-week">
            <div class="date-select d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <img
                        src="https://img.freepik.com/premium-photo/cartoonish-3d-animation-boy-glasses-with-blue-hoodie-orange-shirt_899449-25777.jpg"
                        alt="Avatar" class="avatar">
                    <h1>Hi, {{Auth::guard('web')->user()->first_name .' ' .Auth::guard('web')->user()->last_name}}</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-primary" type="button" id="add_task">ADD</button>
                    <select class="form-select" id="month_wise_filter" name="month_wise_filter">
                        <option value="1" @if($currentMonth == '01') selected @endif>January</option>
                        <option value="2" @if($currentMonth == '02') selected @endif>February</option>
                        <option value="3" @if($currentMonth == '03') selected @endif>March</option>
                        <option value="4" @if($currentMonth == '04') selected @endif>April</option>
                        <option value="5" @if($currentMonth == '05') selected @endif>May</option>
                        <option value="6" @if($currentMonth == '06') selected @endif>June</option>
                        <option value="7" @if($currentMonth == '07') selected @endif>July</option>
                        <option value="8" @if($currentMonth == '08') selected @endif>August</option>
                        <option value="9" @if($currentMonth == '09') selected @endif>September</option>
                        <option value="10" @if($currentMonth == '10') selected @endif>October</option>
                        <option value="11" @if($currentMonth == '11') selected @endif>November</option>
                        <option value="12" @if($currentMonth == '12') selected @endif>December</option>
                    </select>
                    <select class="form-select" id="year_wise_filter" name="year_wise_filter">
                        <option value="2024" @if($currentYear == '2024') selected @endif>2024</option>
                        <option value="2023" @if($currentYear == '2023') selected @endif>2023</option>
                        <option value="2022" @if($currentYear == '2022') selected @endif>2022</option>
                        <option value="2021" @if($currentYear == '2021') selected @endif>2021</option>
                        <option value="2020" @if($currentYear == '2020') selected @endif>2020</option>
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <div class="row">
                    @foreach($ranges as $key => $rangeData)
                        @php
                            $isActive = ($rangeData['range'] === $currentWeekRange) ? 'active' : '';
                        @endphp
                        <div class="custom-col">
                            <div class="card card-hover p-1 {{ $isActive }}" id="card{{$key}}"
                                 onclick="activateCard('card{{$key}}')">

                                <div class="card-body card_date_filter text-center" data-key="{{$key}}">
                                    <input type="hidden" id="date_range{{$key}}" name="date_range{{$key}}"
                                           data-start-date="{{$rangeData['start']}}"
                                           data-end-date="{{$rangeData['end']}}">
                                    <h3>{{$rangeData['range']}}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr style="background-color: black">
        </div>
        <div class="body" id="week_wise_filter_part">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped" id="table">
                        <tbody>
                        @foreach($dateArrays as $key=>$date)
                            @php
                                $employee_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date',$date)->get();
                                $task_pending_count = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date',$date)->where('status','pending')->count();
                                $submitted_hours = 0;
                                $approved_hours = 0;
                                $rejected_hours = 0;
                                $submitted_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date',$date)->where('status','pending')->get();
                                $approved_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date',$date)->where('status','approved')->get();
                                $rejected_tasks = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date',$date)->where('status','reject')->get();
                                 foreach ($submitted_tasks as $submitted_task) {
                                     $startTime = \Carbon\Carbon::parse($submitted_task->start_time);
                                     $endTime = \Carbon\Carbon::parse($submitted_task->end_time);
                                     $submitted_hours += $endTime->diffInHours($startTime);
                                }
                                 foreach ($approved_tasks as $approved_task) {
                                     $startTime = \Carbon\Carbon::parse($approved_task->start_time);
                                     $endTime = \Carbon\Carbon::parse($approved_task->end_time);
                                     $approved_hours += $endTime->diffInHours($startTime);
                                }
                                 foreach ($rejected_tasks as $rejected_task) {
                                     $startTime = \Carbon\Carbon::parse($rejected_task->start_time);
                                     $endTime = \Carbon\Carbon::parse($rejected_task->end_time);
                                     $rejected_hours += $endTime->diffInHours($startTime);
                                }

                            @endphp
                            <tr>
                                <td>{{Carbon\Carbon::parse($date)->format('d-m-Y')}}<br><strong>{{$key}}</strong></td>
                                <td>Submitted Hours<br><strong>{{$submitted_hours}} hours</strong></td>
                                <td>Approved Hours<br><strong>{{$approved_hours}} hours</strong></td>
                                <td>Rejected Hours<br><strong>{{$rejected_hours}} hours</strong></td>
                                <td>Location<br><strong>{{Auth::guard('web')->user()->location}}</strong></td>
                                <td>Status<br>
                                    @if($employee_tasks->count() > 0)
                                        @if($task_pending_count > 0)
                                            <strong class="status-present">Submitted</strong>
                                        @else
                                            <strong class="status-present">Approved</strong>
                                        @endif
                                    @else
                                        <strong class="status-present">Need To Submit</strong>
                                    @endif
                                </td>
                                <td><span class="toggle-icon cursor-pointer"><i
                                            class="fa-solid fa-caret-down"></i></span>
                                </td>
                            </tr>
                            <tr class="card table-details mb-3" style="display: none;">
                                <td colspan="8">
                                    <table class="text-center status-table">
                                        <thead class="text-dark">
                                        <tr>
                                            <th>Project</th>
                                            <th>Description</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Location</th>
                                            <th>Approval</th>
                                        </tr>
                                        </thead>
                                        <tbody class="task-detail">
                                        @if(count($employee_tasks)>0)
                                            @foreach($employee_tasks as $employee_task)
                                                <tr>
                                                    <td>{{$employee_task->project}}</td>
                                                    <td>{{$employee_task->description}}</td>
                                                    <td>{{\Carbon\Carbon::parse($employee_task->start_time)->format('H:i A')}}</td>
                                                    <td>{{\Carbon\Carbon::parse($employee_task->end_time)->format('H:i A')}}</td>
                                                    <td>{{$employee_task->location}}</td>
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
                                        @else
                                            <tr>
                                                <td>
                                                    <p class="text-dark text-center">This Date Task Not Added</p>
                                                </td>
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
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var modal_form_url = '/task-store'
        var redirect_url = '/home'

        function activateCard(cardId) {
            // Remove 'active' class from all cards
            document.querySelectorAll('.card').forEach(card => {
                card.classList.remove('active');
            });

            // Add 'active' class to the clicked card
            document.getElementById(cardId).classList.add('active');
        }

        $('.card_date_filter').on('click', function () {
            key = $(this).data('key')
            start_date = $("#date_range" + key).data('start-date');
            end_date = $("#date_range" + key).data('end-date');
            axios
                .post(APP_URL + '/card-date-filter', {
                    start_date: start_date,
                    end_date: end_date,
                })
                .then(function (response) {
                    loaderHide()
                    $('#week_wise_filter_part').html(response.data.data)
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        })

        $('#month_wise_filter').on('change', function () {
            month_wise_filter = $("#month_wise_filter").val();
            year_wise_filter = $("#year_wise_filter").val();
            axios
                .post(APP_URL + '/month-year-filter', {
                    month_wise_filter: month_wise_filter,
                    year_wise_filter: year_wise_filter,
                })
                .then(function (response) {
                    loaderHide()
                    $('#emp-dashboard').html(response.data.data)
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        })
        $('#year_wise_filter').on('change', function () {
            month_wise_filter = $("#month_wise_filter").val();
            year_wise_filter = $("#year_wise_filter").val();
            axios
                .post(APP_URL + '/month-year-filter', {
                    month_wise_filter: month_wise_filter,
                    year_wise_filter: year_wise_filter,
                })
                .then(function (response) {
                    loaderHide()
                    $('#emp-dashboard').html(response.data.data)
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    loaderHide()
                })
        })
    </script>
    <script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
@endsection
