<?php

namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Company\HolidayStoreRequest;
use App\Models\Holiday;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{

    public function index()
    {
        $company_id = Auth::guard('company')->user()->id;
        $settings = Setting::select(['setting_key', 'setting_value'])->get();
        $holidays = Holiday::where('company_id', $company_id)->get();
        return view('company.setting.index', [
            'settings' => $settings,
            'holidays' => $holidays,
        ]);
    }

    public function HolidayStore(HolidayStoreRequest $request)
    {
        $company_id = Auth::guard('company')->user()->id;
        Holiday::where('company_id', $company_id)->truncate();
        foreach ($request->holiday_title as $key => $title) {
            Holiday::create([
                'company_id' => $company_id,
                'title' => $title,
                'date' => $request->holiday_date[$key],
            ]);
        }

        return response()->json([
            'message' => 'Holiday Date Update Successfully',
        ]);
    }

}
