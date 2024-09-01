<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\OvertimeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OvertimeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department_id = Auth::user()->manager->department_id;
        $overtime_requests = OvertimeRequest::select('overtime_requests.id', 'users.name as employee_name', 'departments.name as department_name', 'overtime_requests.created_at', 'overtime_requests.date', 'overtime_requests.start_time', 'overtime_requests.end_time', 'overtime_requests.duration', 'overtime_requests.reason')
            ->join('employees', 'employees.id', '=', 'overtime_requests.employee_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->orderBy('overtime_requests.created_at', 'desc')
            ->where('employees.department_id', $department_id)
            ->paginate(10);

        return Inertia::render('Manager/OvertimeRequests/Index', [
            'overtime_requests' => $overtime_requests
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
        $validated = $request->validate([
            'user_id' => ['required'],
            'date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'duration' => ['required'],
            'reason' => ['required'],
        ]);


        if ($validated) {

            $employee_id = Employee::where('user_id', $validated['user_id'])->first()->id;

            $overtime_request = OvertimeRequest::create([
                'employee_id' => $employee_id,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'duration' => $request->duration,
                'reason' => $request->reason,
            ]);

            if ($overtime_request) {
                return response()->json(['success' => 'Overtime request created successfully'], 200);
            }
        }

        return response()->json(['error' => 'Something went wrong'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(OvertimeRequest $overtimeRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OvertimeRequest $overtimeRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OvertimeRequest $overtimeRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $overtime_request = OvertimeRequest::find($id);

        $overtime_request->delete();

        return response()->json(['success' => 'Overtime request deleted successfully'], 200);
    }
}