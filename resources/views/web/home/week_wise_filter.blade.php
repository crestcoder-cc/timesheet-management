@php use App\Models\EmployeeTask;use Illuminate\Support\Facades\Auth; @endphp
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
</script>
