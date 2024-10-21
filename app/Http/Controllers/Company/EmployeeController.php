<?php

namespace App\Http\Controllers\Company;

use App\Exports\EmployeeReportExport;
use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EmployeeStoreRequest;
use App\Mail\EmployeePasswordMail;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('company_id', Auth::guard('company')->user()->id)->get();
        return view('company.employee.index', [
            'employees' => $employees
        ]);
    }

    public function getDatatable(Request $request)
    {
        $employee = Employee::where('company_id', Auth::guard('company')->user()->id)->orderBy('id', 'desc');
        return Datatables::of($employee)
            ->addColumn('action', function ($employee) {
                $actions['edit'] = route('company.employee.edit', [$employee->id]);
                $actions['delete'] = $employee->id;
                $actions['view-page'] = route('company.employee.show', [$employee->id]);
                $array = [
                    'id' => $employee->id,
                    'actions' => $actions
                ];
                return AdminDataTableButtonHelper::datatableButton($array);
            })
            ->addColumn('status', function ($employee) {
                return AdminDataTableBadgeHelper::statusBadge($employee);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function employeeTask(Request $request, $id)
    {
        $employee = EmployeeTask::where('employee_id', $id);
        if ($request->has('from_date') && $request->has('to_date')) {
            $start_date = Carbon::parse($request->from_date)->startOfDay();
            $end_date = Carbon::parse($request->to_date)->endOfDay();
            $employee->whereBetween('date', [$start_date, $end_date]);
        }
        return Datatables::of($employee)
            ->addColumn('status', function ($employee) {
                return AdminDataTableBadgeHelper::taskStatusBadge($employee);
            })
            ->addColumn('client', function ($employee) {
                return str_replace('_', ' ', ucfirst($employee->client));
            })
            ->addColumn('date', function ($employee) {
                return Carbon::parse($employee->date)->format('d-m-Y');
            })
            ->addColumn('start_time', function ($employee) {
                return Carbon::parse($employee->start_time)->format('h:i A');
            })
            ->addColumn('end_time', function ($employee) {
                return Carbon::parse($employee->end_time)->format('h:i A');
            })
            ->addColumn('total_hour', function ($employee) {
                $start_time = Carbon::parse($employee->start_time);
                $end_time = Carbon::parse($employee->end_time);
                $total_duration = $end_time->diff($start_time);
                $hours = $total_duration->h;
                $minutes = $total_duration->i;
                $hours += intdiv($minutes, 60);
                $minutes = $minutes % 60;
                $total_rhours = sprintf('%02d:%02d', $hours, $minutes);
                return $total_rhours;
            })
            ->addColumn('ot_hour', function ($employee) {
                $overtime_record = DB::table('employee_tasks')->where('date', $employee->date)->get();
                $total_hours = 0;
                $total_minutes = 0;
                $isPending = true;
                foreach ($overtime_record as $task) {
                    if ($task->status == 'approved') {
                        $isPending = false;
                        $start_time = Carbon::parse($task->start_time);
                        $end_time = Carbon::parse($task->end_time);
                        $total_hours_duration = $end_time->diff($start_time);
                        $total_hours += $total_hours_duration->h;
                        $total_minutes += $total_hours_duration->i;
                    }
                }
                if ($isPending) {
                    foreach ($overtime_record as $task) {
                        if ($task->status == 'pending') {
                            $start_time = Carbon::parse($task->start_time);
                            $end_time = Carbon::parse($task->end_time);
                            $total_hours_duration = $end_time->diff($start_time);
                            $total_hours += $total_hours_duration->h;
                            $total_minutes += $total_hours_duration->i;
                        }
                    }
                }
                $total_hours += intdiv($total_minutes, 60);
                $total_minutes = $total_minutes % 60;

                $overtime_minutes = max(0, ($total_hours * 60 + $total_minutes) - 480);
                $overtime_hours = intdiv($overtime_minutes, 60);
                $overtime_remainder_minutes = $overtime_minutes % 60;
                $overtime_time_formatted = sprintf('%02d:%02d', $overtime_hours, $overtime_remainder_minutes);
                return $overtime_time_formatted;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function create()
    {
        return view('company.employee.create');
    }

    public function store(EmployeeStoreRequest $request)
    {
        if ((int)$request['edit_value'] === 0) {
            $employee = new Employee();
            do {
                $uniqueId = mt_rand(111111111, 999999999);
            } while (Employee::where('unique_id', $uniqueId)->exists());
            $employee->unique_id = $uniqueId;
            $employee->company_id = Auth::guard('company')->user()->id;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->mobile_no = $request->mobile_no;
            $employee->registration_date = $request->registration_date;
            $employee->overtime_permission = $request->overtime_permission;
            $employee->gender = $request->gender;
            $employee->department = $request->department;
            $employee->address = $request->address;
            $employee->location = $request->location;
            $employee->password = \Hash::make($uniqueId);
            $employee->save();
            $array = [
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'mail_title' => 'Set Password',
                'main_title_text' => 'Set Your Password By Company',
                'subject' => 'Set Password',
                'login_url' => url('/login'),
                'email' => $employee->email,
                'password' => $uniqueId
            ];
            Mail::to($request->input('email'))->send(new EmployeePasswordMail($array));
            return response()->json([
                'message' => 'Employee added successfully',
            ]);
        } else {
            $editId = $request['edit_value'];
            $employee = Employee::find($editId);
            $employee->company_id = Auth::guard('company')->user()->id;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->mobile_no = $request->mobile_no;
            $employee->registration_date = $request->registration_date;
            $employee->overtime_permission = $request->overtime_permission;
            $employee->gender = $request->gender;
            $employee->department = $request->department;
            $employee->address = $request->address;
            $employee->location = $request->location;
            if ($request->password) {
                $employee->password = \Hash::make($request->password);
            }
            $employee->save();

            return response()->json([
                'message' => 'Employee updated successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('company.employee.edit', compact('employee'));
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json([
            'message' => 'Employee deleted successfully',
        ]);
    }

    public function changeStatus($id, $status)
    {
        $employee = Employee::find($id);
        $employee->status = $status;
        $employee->save();

        return response()->json([
            'message' => 'Employee status updated successfully',
        ]);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('company.employee.show', compact('employee'));
    }

    public function taskReject(Request $request)
    {
        $employee_task = EmployeeTask::find($request->task_id);
        $employee_task->status = 'reject';
        $employee_task->reject_reason = $request->reject_reason;
        $employee_task->save();
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
        $view = view('company.dashboard.render_dashboard', [
            'employee_count' => $employee_count,
            'holiday_count' => $holiday_count,
            'holidays' => $holidays,
            'employees' => $employees,
            'calender_mark_holiday' => $calender_mark_holiday,
            'task_pending_hours' => $task_pending_hours,
            'task_approved_hours' => $task_approved_hours,
            'overtimeFormatted' => $overtimeFormatted,
        ])->render();

        return response()->json([
            'data' => $view,
            'message' => 'Employee Task Reject successfully',
        ]);
    }

    public function employeeReport(Request $request)
    {
        $employee = Employee::where('company_id', Auth::guard('company')->user()->id)->where('id', $request->user_id)->first();
        $employee_tasks = DB::table('employee_tasks')->where('employee_id', $employee->id);
        [$startDate, $endDate] = explode(' To ', $request->date_range);
        $startDate = Carbon::createFromFormat('d-m-Y', $startDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d-m-Y', $endDate)->format('Y-m-d');
        if ($request->status == 'all') {
            $employee_tasks = $employee_tasks->whereBetween('date', [$startDate, $endDate])->get();
        } else {
            $employee_tasks = $employee_tasks->where('status', $request->status)->whereBetween('date', [$startDate, $endDate])->get();
        }
        $uniqueFileName = 'Employee_Report_' . time() . '_' . uniqid() . '.xlsx';
        Excel::store(new EmployeeReportExport($employee, $employee_tasks,$startDate,$endDate), $uniqueFileName, 'excel_uploads');

        // Return the URL to access the file
        return response()->json(['url' => url('assets/uploads/report/' . $uniqueFileName)]);
    }
}
