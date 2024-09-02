<?php

use App\Http\Controllers\DashboardController;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\OvertimeRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OvertimeRequestController;
use App\Http\Controllers\OvertimeApprovalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/departments', [DepartmentController::class, 'get']);

Route::prefix('/overtime_requests')->name('overtime_requests.')->group(function () {
    Route::get('/', [OvertimeRequestController::class, 'index']);
    Route::post('/store', [OvertimeRequestController::class, 'store']);
    Route::delete('/destroy/{id}', [OvertimeRequestController::class, 'destroy']);

    Route::put('/{id}/approve', [OvertimeRequestController::class, 'approve']);
    Route::put('/{id}/pending', [OvertimeRequestController::class, 'pending']);
    Route::put('/{id}/reject', [OvertimeRequestController::class, 'reject']);
});

Route::prefix('/overtime_approvals')->name('overtime_approvals.')->group(function () {
    Route::get('/', [OvertimeApprovalController::class, 'index']);
    Route::post('/store', [OvertimeApprovalController::class, 'store']);
    Route::delete('/destroy/{id}', [OvertimeApprovalController::class, 'destroy']);

});

Route::post('/manager/signature', [DashboardController::class, 'storeManager'])->name('api.manager.signature');