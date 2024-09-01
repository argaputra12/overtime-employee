<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\OvertimeRequest;
use App\Models\OvertimeApproval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();

        $overtime_requests = OvertimeRequest::where('employee_id', $employee->id)->paginate(10);
        $overtime_approvals = OvertimeApproval::select('overtime_approvals.*', 'users.name as manager_name')
        ->whereIn('overtime_request_id', $overtime_requests->pluck('id'))
        ->join('overtime_requests', 'overtime_requests.id', '=', 'overtime_approvals.overtime_request_id')
        ->join('managers', 'managers.id', '=', 'overtime_approvals.manager_id')
        ->join('users', 'users.id', '=', 'managers.user_id')
        ->paginate(10);

        return Inertia::render('Dashboard', [
            'overtime_requests' => $overtime_requests,
            'overtime_approvals' => $overtime_approvals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}