<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyStoreRequest;
use App\Models\Company;
use Illuminate\Http\Request;
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
                return AdminDataTableButtonHelper::actionButtonDropdown2($array);
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
            $company->password = \Hash::make($request->password);
            $company->save();

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
            if($request->password){
                $company->password = \Hash::make($request->password);
            }
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
}
