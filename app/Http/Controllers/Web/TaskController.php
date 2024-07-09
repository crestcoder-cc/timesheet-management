<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EmployeeStoreRequest;
use App\Http\Requests\Web\TaskStoreRequest;
use App\Mail\EmployeePasswordMail;
use App\Models\Employee;
use App\Models\EmployeeTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function store(TaskStoreRequest $request)
    {
        $employee = new EmployeeTask();
        $employee->employee_id = Auth::guard('web')->user()->id;
        $employee->project = $request->project;
        $employee->task = $request->task;
        $employee->description = $request->description;
        $employee->date = $request->date;
        $employee->start_time = $request->start_time;
        $employee->end_time = $request->end_time;
        $employee->location = $request->location;
        $employee->save();

        return response()->json([
            'message' => 'Task added successfully',
        ]);
    }

    public function taskUpdate($id)
    {
        $employee = EmployeeTask::where('id', $id)->first();
        $view = view('web.resubmit.task_update_modal_body_render', [
            'employee' => $employee
        ])->render();
        return response()->json([
            'data' => $view,
        ]);
    }

    public function taskUpdateStore(TaskStoreRequest $request)
    {
        $employee = EmployeeTask::find($request->employee_task_id);
        $employee->employee_id = Auth::guard('web')->user()->id;
        $employee->project = $request->project;
        $employee->task = $request->task;
        $employee->description = $request->description;
        $employee->date = $request->date;
        $employee->start_time = $request->start_time;
        $employee->end_time = $request->end_time;
        $employee->location = $request->location;
        $employee->status = 'pending';
        $employee->save();

        return response()->json([
            'message' => 'Task Update successfully',
        ]);
    }
}
