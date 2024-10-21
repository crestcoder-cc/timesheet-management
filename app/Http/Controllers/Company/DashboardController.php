<?php

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Company\SearchTaskDetailRequest;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $employee_count = Employee::where('company_id', Auth::guard('company')->user()->id)->whereNull('deleted_at')->count();
        $holiday_count = Holiday::where('company_id', Auth::guard('company')->user()->id)->count();
        $currentMonth = Carbon::now()->month;
        $holidays = Holiday::whereMonth('date', $currentMonth)->where('company_id', Auth::guard('company')->user()->id)->get();
        $calender_mark_holiday = Holiday::where('company_id', Auth::guard('company')->user()->id)->get();
        $employees = Employee::where('company_id', Auth::guard('company')->user()->id)->get();

        $task_pending_hours = 0;
        $task_approved_hours = 0;
        $task_reject_hours = 0;
        $task_reject_hours = 0;
        $task_pending = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)->where('status', 'pending')->get();
        $task_approved = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)->where('status', 'approved')->get();
        $task_reject = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)->where('status', 'reject')->get();
        if (count($task_pending) > 0) {
            foreach ($task_pending as $task_p) {
                $startTimeP = Carbon::parse($task_p->start_time);
                $endTimeP = Carbon::parse($task_p->end_time);
                $task_pending_hours += $endTimeP->diffInMinutes($startTimeP);
            }
            $hours = floor($task_pending_hours / 60);
            $minutes = $task_pending_hours % 60;
            $task_pending_hours = sprintf('%02d:%02d', $hours, $minutes);
        }
        $totalApprovedMinutes = 0;
        if (count($task_approved) > 0) {
            foreach ($task_approved as $task_a) {
                $startTimeA = Carbon::parse($task_a->start_time);
                $endTimeA = Carbon::parse($task_a->end_time);
                $task_approved_hours += $endTimeA->diffInMinutes($startTimeA);
            }
            $hours = floor($task_approved_hours / 60);
            $minutes = $task_approved_hours % 60;
            $task_approved_hours = sprintf('%02d:%02d', $hours, $minutes);
            list($hours, $minutes) = explode(':', $task_approved_hours);
            $totalApprovedMinutes = $hours * 60 + $minutes;
        }
        if (count($task_reject) > 0) {
            foreach ($task_reject as $task_r) {
                $startTimeR = Carbon::parse($task_r->start_time);
                $endTimeR = Carbon::parse($task_r->end_time);
                $task_reject_hours += $endTimeR->diffInMinutes($startTimeR);
            }
            $hours = floor($task_reject_hours / 60);
            $minutes = $task_reject_hours % 60;
            $task_reject_hours = sprintf('%02d:%02d', $hours, $minutes);
        }
        $overtimeMinutes = 0;
        $approvedTasks = DB::table('employee_tasks')
            ->where('company_id', Auth::guard('company')->user()->id)
            ->where('status', 'approved')
            ->get();

        foreach ($approvedTasks as $task) {
            $startTime = Carbon::parse($task->start_time);
            $endTime = Carbon::parse($task->end_time);
            $taskDurationMinutes = $endTime->diffInMinutes($startTime);
            if ($taskDurationMinutes > 480) {
                $overtimeMinutes += $taskDurationMinutes - 480;
            }
        }
        $overtimeHours = floor($overtimeMinutes / 60);
        $overtimeMinutes = $overtimeMinutes % 60;
        $overtimeFormatted = sprintf('%02d:%02d', $overtimeHours, $overtimeMinutes);
        list($overtimeHours, $overtimeMinutes) = explode(':', $overtimeFormatted);
        $totalOvertimeMinutes = $overtimeHours * 60 + $overtimeMinutes;
        if ($overtimeFormatted == '00:00') {
            $overtimeFormatted = 0;
            $totalOvertimeMinutes = 0;
        }
        $finalApprovedMinutes = $totalApprovedMinutes - $totalOvertimeMinutes;
        $finalHours = floor($finalApprovedMinutes / 60);
        $finalMinutes = $finalApprovedMinutes % 60;
        $task_approved_hours = sprintf('%02d:%02d', $finalHours, $finalMinutes);
        $users = DB::table('employees')
            ->where('company_id', Auth::guard('company')->user()->id)
            ->where('status', 'active')->get();
        return view('company.dashboard.dashboard', [
            'employee_count' => $employee_count,
            'holiday_count' => $holiday_count,
            'holidays' => $holidays,
            'employees' => $employees,
            'calender_mark_holiday' => $calender_mark_holiday,
            'task_pending_hours' => $task_pending_hours,
            'task_approved_hours' => $task_approved_hours,
            'overtimeFormatted' => $overtimeFormatted,
            'users' => $users,
        ]);
    }

    public function taskStatus($id, $status)
    {
        EmployeeTask::where('id', $id)->update([
            'status' => $status
        ]);
        $employee_count = Employee::where('company_id', Auth::guard('company')->user()->id)->whereNull('deleted_at')->count();
        $holiday_count = Holiday::where('company_id', Auth::guard('company')->user()->id)->count();
        $currentMonth = Carbon::now()->month;
        $holidays = Holiday::whereMonth('date', $currentMonth)->where('company_id', Auth::guard('company')->user()->id)->get();
        $calender_mark_holiday = Holiday::where('company_id', Auth::guard('company')->user()->id)->get();
        $employees = Employee::where('company_id', Auth::guard('company')->user()->id)->get();

        $task_pending_hours = 0;
        $task_approved_hours = 0;
        $task_reject_hours = 0;
        $task_reject_hours = 0;
        $task_pending = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)->where('status', 'pending')->get();
        $task_approved = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)->where('status', 'approved')->get();
        $task_reject = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)->where('status', 'reject')->get();
        if (count($task_pending) > 0) {
            foreach ($task_pending as $task_p) {
                $startTimeP = Carbon::parse($task_p->start_time);
                $endTimeP = Carbon::parse($task_p->end_time);
                $task_pending_hours += $endTimeP->diffInMinutes($startTimeP);
            }
            $hours = floor($task_pending_hours / 60);
            $minutes = $task_pending_hours % 60;
            $task_pending_hours = sprintf('%02d:%02d', $hours, $minutes);
        }
        $totalApprovedMinutes = 0;
        if (count($task_approved) > 0) {
            foreach ($task_approved as $task_a) {
                $startTimeA = Carbon::parse($task_a->start_time);
                $endTimeA = Carbon::parse($task_a->end_time);
                $task_approved_hours += $endTimeA->diffInMinutes($startTimeA);
            }
            $hours = floor($task_approved_hours / 60);
            $minutes = $task_approved_hours % 60;
            $task_approved_hours = sprintf('%02d:%02d', $hours, $minutes);
            list($hours, $minutes) = explode(':', $task_approved_hours);
            $totalApprovedMinutes = $hours * 60 + $minutes;
        }
        if (count($task_reject) > 0) {
            foreach ($task_reject as $task_r) {
                $startTimeR = Carbon::parse($task_r->start_time);
                $endTimeR = Carbon::parse($task_r->end_time);
                $task_reject_hours += $endTimeR->diffInMinutes($startTimeR);
            }
            $hours = floor($task_reject_hours / 60);
            $minutes = $task_reject_hours % 60;
            $task_reject_hours = sprintf('%02d:%02d', $hours, $minutes);
        }
        $overtimeMinutes = 0;
        $approvedTasks = DB::table('employee_tasks')
            ->where('company_id', Auth::guard('company')->user()->id)
            ->where('status', 'approved')
            ->get();

        foreach ($approvedTasks as $task) {
            $startTime = Carbon::parse($task->start_time);
            $endTime = Carbon::parse($task->end_time);
            $taskDurationMinutes = $endTime->diffInMinutes($startTime);
            if ($taskDurationMinutes > 480) {
                $overtimeMinutes += $taskDurationMinutes - 480;
            }
        }
        $overtimeHours = floor($overtimeMinutes / 60);
        $overtimeMinutes = $overtimeMinutes % 60;
        $overtimeFormatted = sprintf('%02d:%02d', $overtimeHours, $overtimeMinutes);
        list($overtimeHours, $overtimeMinutes) = explode(':', $overtimeFormatted);
        $totalOvertimeMinutes = $overtimeHours * 60 + $overtimeMinutes;
        if ($overtimeFormatted == '00:00') {
            $overtimeFormatted = 0;
            $totalOvertimeMinutes = 0;
        }
        $finalApprovedMinutes = $totalApprovedMinutes - $totalOvertimeMinutes;
        $finalHours = floor($finalApprovedMinutes / 60);
        $finalMinutes = $finalApprovedMinutes % 60;
        $task_approved_hours = sprintf('%02d:%02d', $finalHours, $finalMinutes);
        $users = DB::table('employees')
            ->where('company_id', Auth::guard('company')->user()->id)
            ->where('status', 'active')->get();
        $view = view('company.dashboard.render_dashboard', [
            'employee_count' => $employee_count,
            'holiday_count' => $holiday_count,
            'holidays' => $holidays,
            'employees' => $employees,
            'calender_mark_holiday' => $calender_mark_holiday,
            'task_pending_hours' => $task_pending_hours,
            'task_approved_hours' => $task_approved_hours,
            'overtimeFormatted' => $overtimeFormatted,
            'users' => $users,
        ])->render();
        return response()->json([
            'data' => $view,
            'message' => 'Task Status Change Successfully'
        ]);
    }

    public function search(SearchTaskDetailRequest $request)
    {
        $date_range = $request->date_range;
        [$startDate, $endDate] = explode(' To ', $date_range);
        $startDate = Carbon::createFromFormat('d-m-Y', $startDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d-m-Y', $endDate)->format('Y-m-d');
        $status = $request->status;
        $employee_count = Employee::where('company_id', Auth::guard('company')->user()->id)->whereNull('deleted_at')->count();
        $holiday_count = Holiday::where('company_id', Auth::guard('company')->user()->id)->count();
        $currentMonth = Carbon::now()->month;
        $holidays = Holiday::whereMonth('date', $currentMonth)->where('company_id', Auth::guard('company')->user()->id)->get();
        $calender_mark_holiday = Holiday::where('company_id', Auth::guard('company')->user()->id)->get();
        $employees = Employee::where('company_id', Auth::guard('company')->user()->id)->where('id', $request->user_id)->get();

        $task_pending_hours = 0;
        $task_approved_hours = 0;
        $task_reject_hours = 0;
        $task_reject_hours = 0;
        $task_pending = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)
            ->where('status', 'pending')
            ->where('employee_id', $request->user_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        $task_approved = EmployeeTask::where('company_id', Auth::guard('company')->user()->id)
            ->where('status', 'approved')
            ->where('employee_id', $request->user_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        if (count($task_pending) > 0) {
            foreach ($task_pending as $task_p) {
                $startTimeP = Carbon::parse($task_p->start_time);
                $endTimeP = Carbon::parse($task_p->end_time);
                $task_pending_hours += $endTimeP->diffInMinutes($startTimeP);
            }
            $hours = floor($task_pending_hours / 60);
            $minutes = $task_pending_hours % 60;
            $task_pending_hours = sprintf('%02d:%02d', $hours, $minutes);
        }
        $totalApprovedMinutes = 0;
        if (count($task_approved) > 0) {
            foreach ($task_approved as $task_a) {
                $startTimeA = Carbon::parse($task_a->start_time);
                $endTimeA = Carbon::parse($task_a->end_time);
                $task_approved_hours += $endTimeA->diffInMinutes($startTimeA);
            }
            $hours = floor($task_approved_hours / 60);
            $minutes = $task_approved_hours % 60;
            $task_approved_hours = sprintf('%02d:%02d', $hours, $minutes);
            list($hours, $minutes) = explode(':', $task_approved_hours);
            $totalApprovedMinutes = $hours * 60 + $minutes;
        }
        $overtimeMinutes = 0;
        $approvedTasks = DB::table('employee_tasks')
            ->where('company_id', Auth::guard('company')->user()->id)
            ->where('status', 'approved')
            ->where('employee_id', $request->user_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        foreach ($approvedTasks as $task) {
            $startTime = Carbon::parse($task->start_time);
            $endTime = Carbon::parse($task->end_time);
            $taskDurationMinutes = $endTime->diffInMinutes($startTime);
            if ($taskDurationMinutes > 480) {
                $overtimeMinutes += $taskDurationMinutes - 480;
            }
        }
        $overtimeHours = floor($overtimeMinutes / 60);
        $overtimeMinutes = $overtimeMinutes % 60;
        $overtimeFormatted = sprintf('%02d:%02d', $overtimeHours, $overtimeMinutes);
        list($overtimeHours, $overtimeMinutes) = explode(':', $overtimeFormatted);
        $totalOvertimeMinutes = $overtimeHours * 60 + $overtimeMinutes;
        if ($overtimeFormatted == '00:00') {
            $overtimeFormatted = 0;
            $totalOvertimeMinutes = 0;
        }
        $finalApprovedMinutes = $totalApprovedMinutes - $totalOvertimeMinutes;
        $finalHours = floor($finalApprovedMinutes / 60);
        $finalMinutes = $finalApprovedMinutes % 60;
        $task_approved_hours = sprintf('%02d:%02d', $finalHours, $finalMinutes);
        $view = view('company.dashboard.render_task_detail', [
            'employee_count' => $employee_count,
            'holiday_count' => $holiday_count,
            'holidays' => $holidays,
            'employees' => $employees,
            'calender_mark_holiday' => $calender_mark_holiday,
            'task_pending_hours' => $task_pending_hours,
            'task_approved_hours' => $task_approved_hours,
            'overtimeFormatted' => $overtimeFormatted,
            'date_range' => $date_range,
            'status' => $status,
        ])->render();
        return response()->json([
            'data' => $view,
            'task_pending_hours' => $task_pending_hours,
            'task_approved_hours' => $task_approved_hours,
            'overtimeFormatted' => $overtimeFormatted,
        ]);
    }
}
