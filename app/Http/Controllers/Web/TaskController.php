<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EmployeeStoreRequest;
use App\Http\Requests\Web\TaskStoreRequest;
use App\Mail\EmployeePasswordMail;
use App\Models\Absent;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function store(TaskStoreRequest $request)
    {
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $overlapExists = DB::table('employee_tasks')
            ->where('employee_id', Auth::user()->id)
            ->whereDate('date', $request->date)
            ->where('status', '!=', 'reject')
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();
        if ($overlapExists) {
            return response()->json([
                'status' => false,
                'message' => 'A task already exists within the selected time range.'
            ], 400);
        }
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
        $daysInMonth = Carbon::now()->daysInMonth;
        $weekendDaysCount = 0;
        $currentDate = Carbon::now()->startOfMonth()->copy();
        while ($currentDate->lte($endOfMonth)) {
            if ($currentDate->isSaturday() || $currentDate->isSunday()) {
                $weekendDaysCount++;
            }
            $currentDate->addDay();
        }
        $workingDays = $daysInMonth - $weekendDaysCount;
        $currentMonthHours = $workingDays * 8;
//        $currentMonthHours = 160;

        $totalWorkingHours = EmployeeTask::where('employee_id', Auth::user()->id)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get()
            ->sum(function ($task) {
                return Carbon::parse($task->start_time)->diffInHours(Carbon::parse($task->end_time));
            });
        $holidays = DB::table('holidays')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->count();
        $holiday_hours = $holidays * 8;
        $withoutHolidayHours = $currentMonthHours - $holiday_hours;
        if (Auth::guard('web')->user()->overtime_permission == 'no') {
            $date_task = DB::table('employee_tasks')
                ->where('employee_id', Auth::user()->id)
                ->where('date', $request->date)
                ->get();

            $totalDateMinutes = 0;

            if ($date_task->isNotEmpty()) { // Check if there are any tasks for the given date
                foreach ($date_task as $task) {
                    $startTime = Carbon::parse($task->start_time);
                    $endTime = Carbon::parse($task->end_time);
                    $totalDateMinutes += $endTime->diffInMinutes($startTime);
                }
            }
            $currentStartTime = Carbon::parse($request->start_time);
            $currentEndTime = Carbon::parse($request->end_time);
            $currentTaskMinutes = $currentEndTime->diffInMinutes($currentStartTime);
            $totalMinutes = $totalDateMinutes + $currentTaskMinutes;
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;
            if ($totalMinutes > 480) {
                return response()->json([
                    'success' => false,
                    'message' => 'Time exceeds 8 hours, do not proceed.',
                ]);
            }
            if ($withoutHolidayHours >= $totalWorkingHours) {
                $client = DB::table('projects')->where('id', $request->client_id)->first()->name;
                $company_id = DB::table('employees')->where('id', Auth::guard('web')->user()->id)->first()->company_id;
                $employee = new EmployeeTask();
                $employee->employee_id = Auth::guard('web')->user()->id;
                $employee->company_id = $company_id;
                $employee->project = $request->project;
                $employee->client_id = $request->client_id;
                $employee->client = $client;
                $employee->description = $request->description;
                $employee->date = $request->date;
                $employee->start_time = $request->start_time;
                $employee->end_time = $request->end_time;
                $employee->location = $request->location;
                $employee->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Task added successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You cant add more than ' . $withoutHolidayHours . ' hours to the task in this month',
                ]);
            }
        } else {
            $client = DB::table('projects')->where('id', $request->client_id)->first()->name;
            $company_id = DB::table('employees')->where('id', Auth::guard('web')->user()->id)->first()->company_id;
            $employee = new EmployeeTask();
            $employee->employee_id = Auth::guard('web')->user()->id;
            $employee->company_id = $company_id;
            $employee->project = $request->project;
            $employee->client_id = $request->client_id;
            $employee->client = $client;
            $employee->description = $request->description;
            $employee->date = $request->date;
            $employee->start_time = $request->start_time;
            $employee->end_time = $request->end_time;
            $employee->location = $request->location;
            $employee->save();

            return response()->json([
                'success' => true,
                'message' => 'Task added successfully',
            ]);
        }
    }

    public function taskUpdate($id)
    {
        $employee = EmployeeTask::where('id', $id)->first();
        $projects = DB::table('projects')->where('status', 'active')->get();
        $view = view('web.resubmit.task_update_modal_body_render', [
            'employee' => $employee,
            'projects' => $projects,
        ])->render();
        return response()->json([
            'data' => $view,
        ]);
    }

    public function taskUpdateStore(TaskStoreRequest $request)
    {
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $overlapExists = DB::table('employee_tasks')
            ->where('employee_id', Auth::user()->id)
            ->whereDate('date', $request->date)
            ->where('status', '!=', 'reject')
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();
        if ($overlapExists) {
            return response()->json([
                'status' => false,
                'message' => 'A task already exists within the selected time range.'
            ], 400);
        }
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
        $daysInMonth = Carbon::now()->daysInMonth;
        $weekendDaysCount = 0;
        $currentDate = Carbon::now()->startOfMonth()->copy();
        while ($currentDate->lte($endOfMonth)) {
            if ($currentDate->isSaturday() || $currentDate->isSunday()) {
                $weekendDaysCount++;
            }
            $currentDate->addDay();
        }
        $workingDays = $daysInMonth - $weekendDaysCount;
        $currentMonthHours = $workingDays * 8;
//        $currentMonthHours = 160;
        $totalWorkingHours = EmployeeTask::where('employee_id', Auth::user()->id)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->get()
            ->sum(function ($task) {
                return Carbon::parse($task->start_time)->diffInHours(Carbon::parse($task->end_time));
            });
        $holidays = DB::table('holidays')
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->count();
        $holiday_hours = $holidays * 8;
        $withoutHolidayHours = $currentMonthHours - $holiday_hours;
        if (Auth::guard('web')->user()->overtime_permission == 'no') {
            $date_task = DB::table('employee_tasks')
                ->where('employee_id', Auth::user()->id)
                ->where('date', $request->date)
                ->where('status','!=','reject')
                ->get();
            $totalDateMinutes = 0;

            if ($date_task->isNotEmpty()) { // Check if there are any tasks for the given date
                foreach ($date_task as $task) {
                    $startTime = Carbon::parse($task->start_time);
                    $endTime = Carbon::parse($task->end_time);
                    $totalDateMinutes += $endTime->diffInMinutes($startTime);
                }
            }
            $currentStartTime = Carbon::parse($request->start_time);
            $currentEndTime = Carbon::parse($request->end_time);
            $currentTaskMinutes = $currentEndTime->diffInMinutes($currentStartTime);
            $totalMinutes = $totalDateMinutes + $currentTaskMinutes;
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;
            if ($totalMinutes > 480) {
                return response()->json([
                    'success' => false,
                    'message' => 'Time exceeds 8 hours, do not proceed.',
                ]);
            }
            if ($withoutHolidayHours >= $totalWorkingHours) {
                $client = DB::table('projects')->where('id', $request->client_id)->first()->name;
                $company_id = DB::table('employees')->where('id', Auth::guard('web')->user()->id)->first()->company_id;
                $employee = EmployeeTask::find($request->employee_task_id);
                $employee->employee_id = Auth::guard('web')->user()->id;
                $employee->company_id = $company_id;
                $employee->project = $request->project;
                $employee->client_id = $request->client_id;
                $employee->client = $client;
                $employee->description = $request->description;
                $employee->date = $request->date;
                $employee->start_time = $request->start_time;
                $employee->end_time = $request->end_time;
                $employee->location = $request->location;
                $employee->status = 'pending';
                $employee->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Task Update successfully',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'You cant add more than ' . $withoutHolidayHours . ' hours to the task in this month',
                ]);
            }
        } else {
            $client = DB::table('projects')->where('id', $request->client_id)->first()->name;
            $company_id = DB::table('employees')->where('id', Auth::guard('web')->user()->id)->first()->company_id;
            $employee = EmployeeTask::find($request->employee_task_id);
            $employee->employee_id = Auth::guard('web')->user()->id;
            $employee->company_id = $company_id;
            $employee->project = $request->project;
            $employee->client_id = $request->client_id;
            $employee->client = $client;
            $employee->description = $request->description;
            $employee->date = $request->date;
            $employee->start_time = $request->start_time;
            $employee->end_time = $request->end_time;
            $employee->location = $request->location;
            $employee->status = 'pending';
            $employee->save();

            return response()->json([
                'success' => true,
                'message' => 'Task Update successfully',
            ]);
        }
    }

    public function markAbsent(Request $request)
    {
        $absent = new Absent();
        $absent->employee_id = Auth::user()->id;
        $absent->date = $request->absent_date;
        $absent->save();
        return response()->json([
            'success' => true,
            'message' => 'Absent Date Add successfully',
        ]);
    }
}
