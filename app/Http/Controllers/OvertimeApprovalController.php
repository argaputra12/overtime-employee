<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\OvertimeApproval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OvertimeApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manager = Auth::user()->manager->id;
        $overtime_approvals = OvertimeApproval::select('overtime_approvals.status', 'users.name as employee_name', 'overtime_requests.date', 'overtime_requests.start_time', 'overtime_requests.end_time', 'overtime_requests.reason', 'overtime_requests.duration')
            ->join('overtime_requests', 'overtime_requests.id', '=', 'overtime_approvals.overtime_request_id')
            ->join('employees', 'employees.id', '=', 'overtime_requests.employee_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('manager_id', $manager)
            ->orderBy('overtime_approvals.created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Manager/OvertimeApprovals/Index', [
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
    public function show(OvertimeApproval $overtimeApproval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OvertimeApproval $overtimeApproval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OvertimeApproval $overtimeApproval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OvertimeApproval $overtimeApproval)
    {
        //
    }
}