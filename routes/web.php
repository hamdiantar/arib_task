<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth:web', 'manager'])->group(function () {
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('tasks', TaskController::class);
});
Route::middleware(['auth:web', 'employee'])->group(function () {
    Route::post('employee/logout', [LoginController::class, 'logout'])->name('employee.logout');
    Route::get('my-tasks', [TaskController::class, 'getMyTasks'])->name('my_tasks');
    Route::post('my-tasks/update', [TaskController::class, 'updateTask'])->name('my_tasks.update');
    Route::post('my-tasks/update-status', [TaskController::class, 'updateTaskStatus'])->name('my_tasks.update.status');
});
