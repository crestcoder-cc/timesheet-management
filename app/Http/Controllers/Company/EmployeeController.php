<?php

namespace App\Http\Controllers\Company;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EmployeeStoreRequest;
use App\Mail\EmployeePasswordMail;
use App\Models\Employee;
use App\Models\EmployeeTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('company_id', Auth::guard('company')->user()->id)->get();
        return view('company.employee.index',[
            'employees' => $employees
        ]);
    }

    public function getDatatable(Request $request)
    {
        $employee = Employee::where('company_id', Auth::guard('company')->user()->id);
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

    public function employeeTask(Request $request,$id)
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
            ->addColumn('task', function ($employee) {
                return str_replace('_',' ',ucfirst($employee->task));
            })
            ->addColumn('date', function ($employee) {
                return Carbon::parse($employee->date)->format('d-m-Y');
            })
            ->addColumn('start_time', function ($employee) {
                return Carbon::parse($employee->start_time)->format('H:i A');
            })
            ->addColumn('end_time', function ($employee) {
                return Carbon::parse($employee->end_time)->format('H:i A');
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
            $employee->date_of_birth = $request->date_of_birth;
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
            $employee->date_of_birth = $request->date_of_birth;
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
        return response()->json([
            'message' => 'Employee Task Reject successfully',
        ]);
    }
}
