<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Resubmit Task </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form method="POST" data-parsley-validate="" id="updateTaskModalForm" role="form">
        @csrf
        <div class="modal-body">
            <div class="form-container">
                <div class="row">
                    <input type="hidden" name="employee_task_id" id="employee_task_id">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="{{$employee->reject_reason}}" readonly>
                            <label for="project">Reject Reason</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-control" name="client_id" id="client_id" data-popper-placement="Client">
                                <option value="">Select Client</option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}"
                                            @if($employee->client_id == $project->id) selected @endif>{{$project->name}}</option>
                                @endforeach
                            </select>
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
                                  style="height: 100px;">{{$employee->description}}</textarea>
                            <label for="description">Description/Task</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" value="{{$employee->date}}" name="date" id="date"
                                   placeholder="Date">
                            <label for="date">Date</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="{{$employee->start_time}}" name="start_time"
                                   id="start-time"
                                   placeholder="Start Time">
                            <label for="start-time">Start Time</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" value="{{$employee->end_time}}" name="end_time"
                                   id="end-time"
                                   placeholder="End Time">
                            <label for="end-time">End Time</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" value="{{$employee->location}}" name="location"
                                   id="location"
                                   placeholder="Location">
                            <label for="location">Location</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    @php
        $last_record = DB::table('employee_tasks')->where('employee_id',Auth::user()->id)
        ->latest('created_at')
        ->first();
        if (!is_null($last_record)){
            $task_date = Carbon\Carbon::parse($last_record->date)->addDays(1)->format('Y-m-d');
        }else{
        $task_date = \Carbon\Carbon::parse(Auth::user()->registration_date)->format('Y-m-d');
        }

        $minDate = \Carbon\Carbon::parse(Auth::user()->registration_date)->format('Y-m-d');
    @endphp
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var allowedDate = "{{$task_date}}";
        var minDate = "{{$minDate}}";
        console.log(minDate);
        var dateInput = document.getElementById('date');
        dateInput.min = minDate;
        dateInput.max = allowedDate;
        dateInput.value = allowedDate;
    });
</script>
<script>
    let $updateTaskModalForm = $('#updateTaskModalForm')
    $updateTaskModalForm.on('submit', function (e) {
        e.preventDefault()
        loaderView()
        let formData = new FormData($updateTaskModalForm[0])
        axios
            .post(APP_URL + '/task-update-store', formData)
            .then(function (response) {
                if (response.data.success === true) {
                    $updateTaskModalForm[0].reset()
                    $('#update_task_model').modal('hide');
                    window.location.reload()
                    loaderHide()
                    notificationToast(response.data.message, 'success')
                } else {
                    loaderHide()
                    notificationToast(response.data.message, 'warning')
                }
            })
            .catch(function (error) {
                notificationToast(error.response.data.message, 'warning')
                loaderHide()
            })
    })
</script>


