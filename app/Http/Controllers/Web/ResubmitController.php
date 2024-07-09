<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\EmployeeTask;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ResubmitController extends Controller
{
    public function index()
    {
        $employee_id = Auth::guard('web')->user()->id;
        $employee = EmployeeTask::where('id', $employee_id)->first();
        $employee_tasks = EmployeeTask::where('employee_id', $employee_id)->get();
        $dateArrays = [];

// Iterate over each task and group them by date
        foreach ($employee_tasks as $task) {
            $date = Carbon::parse($task->date)->format('Y-m-d');
            if (!isset($dateArrays[$date])) {
                $dateArrays[$date] = [];
            }
            $dateArrays[$date][] = $task;
        }
        return view('web.resubmit.resubmit', [
            'employee' => $employee,
            'dateArrays' => $dateArrays,
        ]);
    }

}
