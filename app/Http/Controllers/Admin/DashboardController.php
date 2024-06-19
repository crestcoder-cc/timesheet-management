<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Holiday;

class DashboardController extends Controller
{
    public function index()
    {
        $companies_count = Company::whereNull('deleted_at')->count();
        $employee_count = Employee::whereNull('deleted_at')->count();
        $holiday_count = Holiday::count();
        $holidays = Holiday::all();
        return view('admin.dashboard.dashboard', [
            'companies_count' => $companies_count,
            'employee_count' => $employee_count,
            'holiday_count' => $holiday_count,
            'holidays' => $holidays,
        ]);
    }

    public function index2()
    {
        return view('admin.dashboard.dashboard2');
    }
}
