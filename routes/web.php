<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/doctor-register', [AuthController::class, 'registerDoctor'])->name('doctor.register');
Route::post('/doctor-register/verify-otp', [AuthController::class, 'verifyDoctorOtp'])->name('doctor.verify.otp');
Route::post('/doctor-register/resend-otp', [AuthController::class, 'resendDoctorOtp'])->name('doctor.resend.otp');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (no auth for now)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Doctor Dashboard
Route::get('/doctor-dashboard', function () {
    return view('doctor-dashboard');
})->name('doctor.dashboard');

// Doctor profile & booking
Route::get('/doctor/{id}', [DoctorController::class, 'show'])->name('doctor.show');
Route::post('/doctor/{id}/book', [DoctorController::class, 'book'])->name('doctor.book');
