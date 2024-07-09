<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyStoreRequest;
use App\Mail\CompanyPasswordMail;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.company.index');
    }

    public function getDatatable(Request $request)
    {
        $company = Company::all();
        return Datatables::of($company)
            ->addColumn('action', function ($company) {
                $actions['edit'] = route('admin.company.edit', [$company->id]);
                $actions['delete'] = $company->id;
                $actions['status'] = $company->status;
                $actions['view-page'] = route('admin.company.show', [$company->id]);
                $array = [
                    'id' => $company->id,
                    'actions' => $actions
                ];
                return AdminDataTableButtonHelper::datatableButton($array);
            })
            ->addColumn('status', function ($company) {
                return AdminDataTableBadgeHelper::statusBadge($company);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(CompanyStoreRequest $request)
    {

        if ((int)$request['edit_value'] === 0) {
            $company = new Company();
            do {
                $uniqueId = mt_rand(111111111, 999999999);
            } while (Company::where('unique_id', $uniqueId)->exists());
            $company->unique_id = $uniqueId;
            $company->name = $request->name;
            $company->person_name = $request->person_name;
            $company->contact_no = $request->contact_no;
            $company->email = $request->email;
            $company->address = $request->address;
            $company->password = \Hash::make($uniqueId);
            $company->save();
            $array = [
                'name' => $company->name,
                'mail_title' => 'Set Password',
                'main_title_text' => 'Set Your Password By Admin',
                'subject' => 'Set Password',
                'login_url' => url('/company/login'),
                'email' => $company->email,
                'password' => $uniqueId
            ];
            Mail::to($request->input('email'))->send(new CompanyPasswordMail($array));
            return response()->json([
                'message' => 'Company added successfully',
            ]);
        } else {
            $editId = $request['edit_value'];
            $company = Company::find($editId);
            $company->name = $request->name;
            $company->person_name = $request->person_name;
            $company->contact_no = $request->contact_no;
            $company->email = $request->email;
            $company->address = $request->address;
            $company->save();

            return response()->json([
                'message' => 'Company updated successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return view('admin.company.edit', compact('company'));
    }

    public function destroy(string $id)
    {
        $company = Company::find($id);
        $company->delete();
        return response()->json([
            'message' => 'Company deleted successfully',
        ]);
    }

    public function changeStatus($id, $status)
    {
        $company = Company::find($id);
        $company->status = $status;
        $company->save();

        return response()->json([
            'message' => 'Company status updated successfully',
        ]);
    }

    public function show($id)
    {
        $company = Company::find($id);
        return view('admin.company.show', compact('company'));
    }

    public function getCompanyWiseEmployee(Request $request,$id)
    {
        $employee = Employee::where('company_id',$id);
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
                return AdminDataTableButtonHelper::datatableButton($array);
            })
            ->addColumn('status', function ($employee) {
                return AdminDataTableBadgeHelper::statusBadge($employee);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
}
