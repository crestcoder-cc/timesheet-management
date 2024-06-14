<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/company-details/{id}', [HomeController::class, 'turfDetails'])->name('company-details');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit']);
Route::post('/forgotPassword', [AuthController::class, 'forgotPasswordSubmit'])->name('forgotPassword');
Route::get('/password/request', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/get-booking-slot', [HomeController::class, 'getBookingSlot'])->name('get-booking-slot');
Route::get('/get-company', [HomeController::class, 'getTurf'])->name('get-company');
Route::post('/update-location', [HomeController::class, 'updateLocation'])->name('update-location');
Route::get('/company-render', [HomeController::class, 'render'])->name('company-render');
Route::get('/book-timeslot', [HomeController::class, 'bookTimeslot'])->name('book-timeslot');
Route::post('/create-temp-booking', [HomeController::class, 'createTempBooking'])->name('create-temp-booking');
Route::get('/make-payment', [HomeController::class, 'makePayment'])->name('make-payment');
Route::get('/payment-success', [HomeController::class, 'PaymentSuccess'])->name('payment-success');
Route::get('/bookings', [HomeController::class, 'bookings'])->name('bookings');
Route::get('/booking/{id}', [HomeController::class, 'bookingDetails'])->name('booking-details');

