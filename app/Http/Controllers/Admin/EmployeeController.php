<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.index');
    }

    public function getDatatable(Request $request)
    {
        $employee = Employee::all();
        return Datatables::of($employee)
            ->addColumn('action', function ($employee) {
//                $actions['edit'] = route('admin.employee.edit', [$employee->id]);
                $actions['delete'] = $employee->id;
                $actions['status'] = $employee->status;
                $actions['view-page'] = route('admin.employee.show', [$employee->id]);
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
        return view('admin.employee.create');
    }

    public function store(EmployeeStoreRequest $request)
    {
        if ((int)$request['edit_value'] === 0) {
            $employee = new Employee();
            do {
                $uniqueId = mt_rand(111111111, 999999999);
            } while (Employee::where('unique_id', $uniqueId)->exists());
            $employee->unique_id = $uniqueId;
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
        return view('admin.employee.edit', compact('employee'));
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
        return view('admin.employee.show', compact('employee'));
    }
}
