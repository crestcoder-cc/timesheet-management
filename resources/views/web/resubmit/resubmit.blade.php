@php use App\Models\EmployeeTask; @endphp
@extends('web.layouts.master')
@section('title')
    Home
@endsection
@section('content')
    <div class="emp-dashboard" id="emp-dashboard">
        <div class="date-week">
            <div class="date-select d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{asset(Auth::guard('web')->user()->image)}}" alt="Avatar" class="avatar">
                    <h1>Hi, {{Auth::guard('web')->user()->first_name .' ' .Auth::guard('web')->user()->last_name}}</h1>
                </div>
                <a href="{{route('home')}}" class="btn btn-primary" onclick="history.back()">Back</a>
            </div>
            <hr style="background-color: black; width: 100%;">


            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($dateArrays) > 0)
                            <table class="table table-striped" id="table">
                                <tbody>
                                @foreach($dateArrays as $date=>$employee_tasks)
                                    @php
                                        $dayName = Carbon\Carbon::parse($date)->format('l');
                                           $task_pending_count = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date',$date)->where('status','pending')->count();
                                   $task_reject_count = EmployeeTask::where('employee_id', Auth::guard('web')->user()->id)->where('date',$date)->where('status','reject')->count();
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
                                    <tr class="custom-reject">
                                        <td class="custom-reject">{{Carbon\Carbon::parse($date)->format('d-m-Y')}}
                                            <br><strong>{{$dayName}}</strong>
                                        </td>
                                        <td class="custom-reject">Submitted Hours<br><strong>{{$submitted_hours}}
                                                hours</strong></td>
                                        <td class="custom-reject">Approved Hours<br><strong>{{$approved_hours}}
                                                hours</strong></td>
                                        <td class="custom-reject">Rejected Hours<br><strong>{{$rejected_hours}}
                                                hours</strong></td>
                                        <td class="custom-reject">
                                            Location<br><strong>{{Auth::guard('web')->user()->location}}</strong></td>
                                        <td class="custom-reject">Status<br>
                                            @if(count($employee_tasks) > 0)
                                                @if($task_pending_count > 0)
                                                    <strong class="status-present">Reject</strong>
                                                @else
                                                    <strong class="status-present">Reject</strong>
                                                @endif
                                            @else
                                                <strong class="status-present">No Task Found</strong>
                                            @endif
                                        </td>
                                        <td class="custom-reject"><span class="toggle-icon cursor-pointer"><i
                                                    class="fa-solid fa-caret-down"></i></span>
                                        </td>
                                    </tr>
                                    <tr class="card table-details mb-3" style="display: none;">
                                        <td colspan="8">
                                            @if(count($employee_tasks)>0)
                                                <table class="text-start status-table">
                                                    <thead class="text-dark">
                                                    <tr>
                                                        <th>Client</th>
                                                        <th>Project</th>
                                                        <th>Description</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Total Hours</th>
                                                        <th>OT Hours</th>
                                                        <th>Location</th>
                                                        <th>Approval</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="task-detail">
                                                    @foreach($employee_tasks as $employee_task)
                                                        <tr>
                                                            <td>{{$employee_task->client}}</td>
                                                            <td>{{$employee_task->project}}</td>
                                                            <td>{{$employee_task->description}}</td>
                                                            <td>{{\Carbon\Carbon::parse($employee_task->start_time)->format('h:i A')}}</td>
                                                            <td>{{\Carbon\Carbon::parse($employee_task->end_time)->format('h:i A')}}</td>
                                                            @php
                                                                $start_time = \Carbon\Carbon::parse($employee_task->start_time);
                                                                $end_time = \Carbon\Carbon::parse($employee_task->end_time);
                                                                $total_duration = $end_time->diff($start_time);
                                                                $hours = $total_duration->h;
                                                                $minutes = $total_duration->i;
                                                                 $hours += intdiv($minutes, 60);
                                            $minutes = $minutes % 60;
                                            $total_rhours  = sprintf('%02d:%02d', $hours, $minutes);
                                            $overtime_record = DB::table('employee_tasks')->where('date',$employee_task->date)->get();
                                            $total_hours = 0;
                                            $total_minutes = 0;
                                            foreach ($overtime_record as $task) {
                                            $start_time = \Carbon\Carbon::parse($task->start_time);
                                            $end_time = \Carbon\Carbon::parse($task->end_time);

                                            $total_hours_duration = $end_time->diff($start_time);
                                            $total_hours += $total_hours_duration->h;
                                            $total_minutes += $total_hours_duration->i;
                                            }
                                            $total_hours += intdiv($total_minutes, 60);
                                            $total_minutes = $total_minutes % 60;
                                            $total_time_formatted  = sprintf('%02d:%02d', $total_hours, $total_minutes);
                                            $overtime_minutes = max(0, ($total_hours * 60 + $total_minutes) - 480);
                                            $overtime_hours = intdiv($overtime_minutes, 60);
                                            $overtime_remainder_minutes = $overtime_minutes % 60;
                                            $overtime_time_formatted = sprintf('%02d:%02d', $overtime_hours, $overtime_remainder_minutes);
                                                            @endphp
                                                            <td>{{ $total_rhours }} hours</td>
                                                            <td>{{$overtime_time_formatted}} hours</td>
                                                            <td>{{$employee_task->location}}</td>
                                                            <td>
                                                                @if($employee_task->status == 'pending')
                                                                    <span class="badge text-bg-warning">Pending</span>
                                                                @elseif($employee_task->status == 'approved')
                                                                    <span class="badge text-bg-success">Approved</span>
                                                                @else
                                                                    <button class="btn btn-primary resubmit-btn"
                                                                            data-id="{{$employee_task->id}}"
                                                                            type="button">
                                                                        Resubmit
                                                                    </button>
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
                        @else
                            <div class="alert alert-info" role="alert">
                                No tasks found
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('custom-script')
            <script>
                var modal_form_url = '/task-update'
                var redirect_url = '/home'

            </script>
            <script src="{{ asset('assets/web/custom/task.js') }}?v={{time()}}"></script>
            <script>
                $('.resubmit-btn').on('click', function () {
                    id = $(this).data('id')
                    loaderView()
                    axios
                        .get(APP_URL + '/task-update/' + id)
                        .then(function (response) {
                            $('#update_task_render').html(response.data.data)
                            $('#employee_task_id').val(id)
                            $('#update_task_model').modal('show');
                            loaderHide()
                        })
                        .catch(function (error) {
                            notificationToast(error.response.data.message, 'warning')
                            loaderHide()
                        })
                })

                $('#btn-close').on('click', function () {
                    $('#add_task_model').modal('hide');
                });
            </script>
            <script src="{{ asset('assets/web/custom/form.js') }}?v={{time()}}"></script>
@endsection
