@php use App\Models\EmployeeTask; @endphp
@extends('web.layouts.master')
@section('title')
    Home
@endsection
@section('content')
    <div class="emp-dashboard" id="emp-dashboard">
        <div class="body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped" id="table">
                        <tbody>
                        @foreach($dateArrays as $date=>$employee_tasks)
                            @php
                                $dayName = Carbon\Carbon::parse($date)->format('l');
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
                                    @if(count($employee_tasks) > 0)
                                        @if($task_pending_count > 0)
                                            <strong class="status-present">Processing</strong>
                                        @else
                                            <strong class="status-present">Complete</strong>
                                        @endif
                                    @else
                                        <strong class="status-present">No Any Task</strong>
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
                                                            <button class="btn btn-primary resubmit-btn"
                                                                    data-id="{{$employee_task->id}}" type="button">
                                                                Resubmit
                                                            </button>
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
