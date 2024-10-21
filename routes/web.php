<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\PasswordController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ResubmitController;
use App\Http\Controllers\Web\TaskController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('/', [LoginController::class, 'login'])->name('/');
Route::post('login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::post('send-mail', [LoginController::class, 'sendMail'])->name('send-mail');
Route::get('forgot-password/{token}', [LoginController::class, 'resetPassword'])->name('forgot-password');
Route::post('reset-password-submit', [LoginController::class, 'resetPasswordSubmit'])->name('reset-password-submit');
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('reset-password', [PasswordController::class, 'index'])->name('reset-password');
    Route::get('resubmit', [ResubmitController::class, 'index'])->name('resubmit');
    Route::get('update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
    Route::post('update-profile-store', [ProfileController::class, 'updateProfileStore'])->name('update-profile-store');
    Route::post('update-password-store', [PasswordController::class, 'updatePassword'])->name('update-password-store');
    Route::post('task-store', [TaskController::class, 'store'])->name('task-store');
    Route::post('mark-absent', [TaskController::class, 'markAbsent'])->name('mark-absent');
    Route::get('task-update/{id}', [TaskController::class, 'taskUpdate'])->name('task-update');
    Route::post('task-update-store', [TaskController::class, 'taskUpdateStore'])->name('task-update-store');
    Route::post('card-date-filter', [HomeController::class, 'cardDateFilter'])->name('card-date-filter');
    Route::post('month-year-filter', [HomeController::class, 'MonthYearFilter'])->name('month-year-filter');
});
