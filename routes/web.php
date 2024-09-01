<?php

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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'manager', 'middleware' => 'manager'], function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Manager/Dashboard');
    })->name('manager.dashboard');

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
    });

    Route::prefix('/overtime_approvals')->name('manager.overtime_approvals.')->group(function () {
        Route::get('/', [OvertimeApprovalController::class, 'index'])->name('index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';