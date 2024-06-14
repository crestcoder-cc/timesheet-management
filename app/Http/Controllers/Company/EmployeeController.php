<?php

namespace App\Http\Controllers\Company;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('company.employee.index');
    }

    public function getDatatable(Request $request)
    {
        $employee = Employee::where('company_id',Auth::guard('company')->user()->id);
        return Datatables::of($employee)
            ->addColumn('action', function ($employee) {
                $actions['edit'] = route('company.employee.edit', [$employee->id]);
                $actions['delete'] = $employee->id;
                $actions['status'] = $employee->status;
                $actions['view-page'] = route('company.employee.show', [$employee->id]);
                $array = [
                    'id' => $employee->id,
                    'actions' => $actions
                ];
                return AdminDataTableButtonHelper::actionButtonDropdown2($array);
            })
            ->addColumn('status', function ($employee) {
                return AdminDataTableBadgeHelper::statusBadge($employee);
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
            $employee->password = \Hash::make($request->password);
            $employee->save();

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
}
