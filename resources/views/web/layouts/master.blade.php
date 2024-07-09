<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $title = DB::table('settings')->where('setting_key','SITE_TITLE')->first()->setting_value;
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="project" name="project"
                                           placeholder="Project">
                                    <label for="project">Project</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control" name="task" id="task" data-popper-placement="Task">
                                        <option value="">Select Task</option>
                                        <option value="develop_react_app">Develop React App</option>
                                        <option value="delete_api">Delete API</option>
                                        <option value="files_api">Flies API</option>
                                        <option value="design_ui_for_super_admin_page">Design UI For Super Admin Page
                                        </option>
                                    </select>
                                    {{--                                <input type="text" class="form-control" id="task" placeholder="Task">--}}
                                    <label for="task">Task</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description" name="description" id="description"
                                  style="height: 100px;"></textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                                    <label for="date">Date</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" name="start_time" id="start-time"
                                           placeholder="Start Time">
                                    <label for="start-time">Start Time</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" name="end_time" id="end-time"
                                           placeholder="End Time">
                                    <label for="end-time">End Time</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-control" name="location" id="location" data-popper-placement="Location">
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
<div id="update_task_model" class="modal modal-lg fade" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="update_task_render">

    </div>
</div>
<!-- Modal -->
@include('web.layouts.script')
</body>
</html>
