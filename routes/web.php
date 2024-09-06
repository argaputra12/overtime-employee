<?php

use App\Http\Controllers\DashboardController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OvertimeRequestController;
use App\Http\Controllers\OvertimeApprovalController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/overtime_approval/show/{id}', [OvertimeApprovalController::class, 'show'])->name('overtime_approval.show');

Route::get('/manager/dashboard', [DashboardController::class, 'manager'])->name('manager.dashboard')->middleware(['auth', 'manager']);

Route::group(['prefix' => 'manager', 'middleware' => 'manager'], function () {

    Route::prefix('/employees')->name('manager.employees.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/managers')->name('manager.managers.')->group(function () {
        Route::get('/', [ManagerController::class, 'index'])->name('index');
        Route::post('/store', [ManagerController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [ManagerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/overtime_requests')->name('manager.overtime_requests.')->group(function () {
        Route::get('/', [OvertimeRequestController::class, 'index'])->name('index');
        Route::post('/store', [OvertimeRequestController::class, 'store'])->name('store');
    });

    Route::prefix('/overtime_approvals')->name('manager.overtime_approvals.')->group(function () {
        Route::get('/', [OvertimeApprovalController::class, 'index'])->name('index');
        Route::post('/store', [OvertimeApprovalController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [OvertimeApprovalController::class, 'destroy'])->name('destroy');

        Route::put('/{id}/approve', [OvertimeApprovalController::class, 'approve']);
        Route::put('/{id}/reject', [OvertimeApprovalController::class, 'reject']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';