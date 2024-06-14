<?php

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $employee_count = Employee::where('company_id', Auth::guard('company')->user()->id)->whereNull('deleted_at')->count();
        $holiday_count = Holiday::count();
        $holidays = Holiday::pluck('date')->toArray();
        return view('company.dashboard.dashboard', [
            'employee_count' => $employee_count,
            'holiday_count' => $holiday_count,
            'holidays' => $holidays,
        ]);
    }
}
