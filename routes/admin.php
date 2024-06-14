<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\TurfController;
use App\Http\Controllers\Admin\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('my-profile', [ProfileController::class, 'index'])->name('my-profile');
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('change-panel-mode/{id}', [DashboardController::class, 'changePanelMode'])->name('change-panel-mode');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/change-password', [PasswordController::class, 'index'])->name('change-password');
    Route::post('update-password', [PasswordController::class, 'updatePassword'])->name('update-password');

    Route::get('/company/status/{id}/{status}', [TurfController::class, 'changeStatus'])->name('change-status-event');
    Route::get('get-company', [TurfController::class, 'getDatatable'])->name('admin.get-company');

    Route::post('approve-company', [TurfController::class, 'approve'])->name('approve-company');
    Route::post('reject-company', [TurfController::class, 'reject'])->name('reject-company');
    Route::resources([
        'company' => TurfController::class,
        'company' => CompanyController::class,
        'employee' => EmployeeController::class,
        'booking' => BookingController::class,
    ]);
    Route::get('get-player', [PlayerController::class, 'getDatatable'])->name('get-player');

    Route::get('get-company', [CompanyController::class, 'getDatatable'])->name('get-company');
    Route::get('/company/status/{id}/{status}', [CompanyController::class, 'changeStatus'])->name('change-status-event');

    Route::get('get-employee', [EmployeeController::class, 'getDatatable'])->name('get-employee');
    Route::get('/employee/status/{id}/{status}', [EmployeeController::class, 'changeStatus'])->name('change-status-event');

    Route::resource('setting', SettingController::class);
    Route::post('general-setting-store', [SettingController::class, 'generalSettingStore'])->name('general-setting-store');
    Route::post('email-setting-store', [SettingController::class, 'emailSettingStore'])->name('email-setting-store');
    Route::post('contact-info-store', [SettingController::class, 'contactInfoStore'])->name('contact-info-store');
    Route::post('social-media-store', [SettingController::class, 'socialMediaStore'])->name('social-media-store');
    Route::post('holiday-date-store', [SettingController::class, 'HolidayStore'])->name('holiday-date-store');

    Route::get('get-states', [TurfController::class, 'getState'])->name('get-states');
    Route::get('get-cities/{id}', [TurfController::class, 'getCity'])->name('get-cities');
    Route::post('get-pincode', [TurfController::class, 'getPincode'])->name('get-pincode');
    Route::get('get-booking', [BookingController::class, 'getDatatable'])->name('admin.get-booking');
});
