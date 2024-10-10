<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
// use App\Http\Controllers\DepartmentsController;
// use App\Http\Controllers\EmployeesController;

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
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');

// Redirect to login if user is not authenticated
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

// Dashboard route, only accessible by authenticated users
Route::get('/dashboard', function () {
    return view('admin.blank.index');
})->middleware(['auth', 'verified'])->name('dashboard');


    // Route untuk Submenu 1
Route::get('/submenu1', [AdminController::class, 'submenu1'])->name('submenu1');

Route::resource('users', UserController::class);

Route::resource('roles', RoleController::class);

// Auth routes (login, register, password reset, etc.)
require __DIR__.'/auth.php';

// Route::resource('departments', DepartmentsController::class);

// Route::resource('employees', EmployeesController::class);