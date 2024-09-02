<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Manager;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\OvertimeRequest;
use App\Models\OvertimeApproval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function manager()
    {
        $manager = Manager::where('user_id', Auth::user()->id)->first();

        return Inertia::render('Manager/Dashboard',
        [
            'user' => Auth::user(),
            'manager' => $manager
        ]);
    }

    public function storeManager(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        if($request->hasFile('signature')) {
            $fileExtension = $request->file('signature')->getClientOriginalExtension();
            $path = $request->file('signature')->storeAs(
                'public/signature',
                $request->name.'_'.$request->user_id.'.'.$fileExtension
            );
            $path = str_replace('public/', 'storage/', $path);

            User::where('id', $request->user_id)->update([
                'signature' => $path
            ]);
        } else {
            return response()->json(['error' => "File gambar tidak terdeteksi"]);
        }

        User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);


        return response()->json(['success' => 'Data anda berhasil diperbarui']);
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