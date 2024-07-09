<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $users = DB::table('employees')
            ->leftjoin('companies', 'employees.company_id', 'companies.id')
            ->where('employees.id', Auth::guard('web')->user()->id)
            ->select('employees.*', 'companies.name as company_name')
            ->first();
        return view('web.profile.profile', [
            'users' => $users
        ]);
    }


    public function updateProfile()
    {
        $users = DB::table('employees')
            ->leftjoin('companies', 'employees.company_id', 'companies.id')
            ->where('employees.id', Auth::guard('web')->user()->id)
            ->select('employees.*', 'companies.name as company_name')
            ->first();
        return view('web.profile.update_profile', [
            'users' => $users
        ]);
    }

    public function updateProfileStore(Request $request)
    {
        $employee = Employee::find(Auth::guard('web')->user()->id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        if ($request->password) {
            $employee->password = \Hash::make($request->password);
        }
        $employee->save();
        return response()->json([
            'message' => 'Profile Update Successfully',
        ]);
    }
}
