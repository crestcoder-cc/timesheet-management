<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $companies_count = Company::whereNull('deleted_at')->count();
        $employee_count = Employee::whereNull('deleted_at')->count();
        $holiday_count = Holiday::count();
        $currentMonth = Carbon::now()->month;
        $holidays = Holiday::whereMonth('date', $currentMonth)->get();
        $calender_mark_holiday = Holiday::all();

        $task_approved_hours = 0;
        $task_approved = EmployeeTask::where('status', 'approved')->get();
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
        $overtimeMinutes=0;
        $approvedTasks = DB::table('employee_tasks')
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
        if ($overtimeFormatted == '00:00'){
            $overtimeFormatted = 0;
            $totalOvertimeMinutes = 0;
        }
        $finalApprovedMinutes = $totalApprovedMinutes - $totalOvertimeMinutes;
        $finalHours = floor($finalApprovedMinutes / 60);
        $finalMinutes = $finalApprovedMinutes % 60;
        $task_approved_hours = sprintf('%02d:%02d', $finalHours, $finalMinutes);
        return view('admin.dashboard.dashboard', [
            'companies_count' => $companies_count,
            'employee_count' => $employee_count,
            'holiday_count' => $holiday_count,
            'holidays' => $holidays,
            'calender_mark_holiday' => $calender_mark_holiday,
            'overtimeFormatted' => $overtimeFormatted,
            'task_approved_hours' => $task_approved_hours,
        ]);
    }

    public function index2()
    {
        return view('admin.dashboard.dashboard2');
    }
}
