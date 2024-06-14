<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BankStoreRequest;
use App\Http\Requests\Admin\ContactInfoStoreRequest;
use App\Http\Requests\Admin\GeneralSettingStoreRequest;
use App\Http\Requests\Admin\EmailSettingStoreRequest;
use App\Http\Requests\Admin\AppSettingStoreRequest;
use App\Http\Requests\Admin\HolidayStoreRequest;
use App\Http\Requests\Admin\SocialMediaStoreRequest;
use App\Models\Holiday;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $settings = Setting::select(['setting_key', 'setting_value'])->get();
        $holidays = Holiday::pluck('date')->toArray();
        return view('admin.setting.index', [
            'settings' => $settings,
            'holidays' => $holidays,
        ]);
    }

    public function generalSettingStore(GeneralSettingStoreRequest $request)
    {

        if ($request->hasfile('LOGO_IMG')) {
            $logo = ImageUploadHelper::imageUpload($request->file('LOGO_IMG'), 'logo');
            DB::table('settings')->where('setting_key', 'LOGO_IMG')->update([
                'setting_value' => $logo
            ]);
        }
        if ($request->hasfile('FAVICON_IMG')) {
            $favicon_icon = ImageUploadHelper::imageUpload($request->file('FAVICON_IMG'), 'logo');
            DB::table('settings')->where('setting_key', 'FAVICON_IMG')->update([
                'setting_value' => $favicon_icon
            ]);
        }

        if ($request->setting_key['SITE_TITLE']) {
            DB::table('settings')->where('setting_key', 'SITE_TITLE')->update([
                'setting_value' => $request->setting_key['SITE_TITLE']
            ]);
        }

        return response()->json(['message' => 'General Setting Update Successfully']);
    }

    public function emailSettingStore(EmailSettingStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
//            Config::set([$key => $setting_value]);
        }
        return response()->json([
            'message' => 'Email Setting Update Successfully',
        ]);
    }

    public function contactInfoStore(ContactInfoStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
        }

        return response()->json([
            'message' => 'Contact Info Update Successfully',
        ]);
    }

    public function socialMediaStore(SocialMediaStoreRequest $request)
    {
        $array = $request->setting_key;
        foreach ($array as $key => $setting_value) {
            DB::table('settings')->where('setting_key', $key)->update([
                'setting_value' => $setting_value
            ]);
        }

        return response()->json([
            'message' => 'Social Media Update Successfully',
        ]);
    }

    public function HolidayStore(HolidayStoreRequest $request)
    {
        Holiday::truncate();
        foreach ($request->holidays as $holidayDate) {
            Holiday::create(['date' => $holidayDate]);
        }

        return response()->json([
            'message' => 'Holiday Date Update Successfully',
        ]);
    }

}
