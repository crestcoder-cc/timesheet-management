<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ResubmitController;
use App\Http\Controllers\Web\TaskController;
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


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('/', [LoginController::class, 'login'])->name('/');
Route::post('login-check', [LoginController::class, 'loginCheck'])->name('login-check');
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('resubmit', [ResubmitController::class, 'index'])->name('resubmit');
    Route::get('update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
    Route::post('update-profile-store', [ProfileController::class, 'updateProfileStore'])->name('update-profile-store');
    Route::post('task-store', [TaskController::class, 'store'])->name('task-store');
    Route::get('task-update/{id}', [TaskController::class, 'taskUpdate'])->name('task-update');
    Route::post('task-update-store', [TaskController::class, 'taskUpdateStore'])->name('task-update-store');
    Route::post('card-date-filter', [HomeController::class, 'cardDateFilter'])->name('card-date-filter');
    Route::post('month-year-filter', [HomeController::class, 'MonthYearFilter'])->name('month-year-filter');
});
