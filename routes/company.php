<?php

use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Company\LoginController;
use App\Http\Controllers\Company\PasswordController;
use App\Http\Controllers\Company\ProfileController;
use App\Http\Controllers\Company\ProjectController;
use App\Http\Controllers\Company\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::post('send-mail', [LoginController::class, 'sendMail'])->name('send-mail');
Route::get('forgot-password/{token}', [LoginController::class, 'resetPassword'])->name('forgot-password');
Route::post('reset-password-submit', [LoginController::class, 'resetPasswordSubmit'])->name('reset-password-submit');
Route::group(['middleware' => ['auth:company']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('my-profile', [ProfileController::class, 'index'])->name('my-profile');
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('change-panel-mode/{id}', [DashboardController::class, 'changePanelMode'])->name('change-panel-mode');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/search', [DashboardController::class, 'search'])->name('search');
    Route::get('/task-status/{id}/{status}', [DashboardController::class, 'taskStatus'])->name('task-status');
    Route::get('/change-password', [PasswordController::class, 'index'])->name('change-password');
    Route::post('update-password', [PasswordController::class, 'updatePassword'])->name('update-password');
    Route::resources([
        'employee' => EmployeeController::class,
        'project' => ProjectController::class,
    ]);
    Route::get('get-employee', [EmployeeController::class, 'getDatatable'])->name('company.get-employee');
    Route::get('/employee/status/{id}/{status}', [EmployeeController::class, 'changeStatus'])->name('change-status-event');
    Route::get('/get-employee-task/{id}', [EmployeeController::class, 'employeeTask'])->name('get-employee-task');
    Route::post('/reject-reason', [EmployeeController::class, 'taskReject'])->name('reject-reason');
    Route::post('employeeReport', [EmployeeController::class, 'employeeReport']);
    Route::get('get-project', [ProjectController::class, 'getDatatable'])->name('company.get-project');
    Route::get('/project/status/{id}/{status}', [ProjectController::class, 'changeStatus'])->name('change-status-event');
    Route::resource('setting', SettingController::class);
    Route::post('holiday-date-store', [SettingController::class, 'HolidayStore'])->name('holiday-date-store');
});
