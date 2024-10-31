<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SendPromotionController;

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

// Redirect to login if user is not authenticated
Route::get('/', function () {
    return redirect('/dashboard');
});

// Dashboard route, only accessible by authenticated users
Route::get('/dashboard', function () {
    return view('admin.blank.index');
})->name('dashboard');


    // Route untuk Submenu 1
Route::get('/submenu1', [AdminController::class, 'submenu1'])->name('submenu1');

Route::resource('users', UserController::class);

Route::resource('roles', RoleController::class);

Route::resource('departments', DepartmentController::class);

Route::resource('employees', EmployeeController::class);
// Rute untuk Employees
Route::prefix('admin')->group(function () {
    Route::resource('employees', EmployeeController::class);
});

Route::resource('payroll', PayrollController::class);
Route::get('/payrolls', [PayrollController::class, 'index'])->name('payroll.index');

Route::resource('leave', \App\Http\Controllers\LeaveController::class);

Route::resource('attendance', AttendanceController::class);

//Email

Route::get('/send-email', [EmailController::class, 'send']);

Route::resource('customers', CustomerController::class);
Route::resource('promotions', PromotionController::class);
Route::post('send-promotion', [SendPromotionController::class, 'send'])->name('send.promotion');
