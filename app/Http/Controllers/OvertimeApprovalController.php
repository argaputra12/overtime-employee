<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $overtime_approvals = OvertimeApproval::select('overtime_approvals.status', 'users.name as employee_name', 'overtime_requests.date', 'overtime_requests.start_time', 'overtime_approvals.id as id', 'overtime_requests.end_time', 'overtime_requests.reason', 'overtime_requests.duration')
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
    public function show($id)
    {
        $overtime_approval = OvertimeApproval::find($id);
        $manager_signature = $overtime_approval->manager->user->signature;
        if ($manager_signature == null) {
            return back()->with('error', 'Manager belum mengupload tanda tangan');
        }
        $employee_signature = $overtime_approval->overtime_request->employee->user->signature;
        if ($employee_signature == null) {
            return back()->with('error', 'Pegawai belum mengupload tanda tangan');
        }

        $date = Carbon::now()->locale('id_ID');
        $today = Carbon::now()->locale('id_ID')->translatedFormat('l j F Y');

        // Change date format using Carbon's translatedFormat method
        $overtime_approval->overtime_request->date = Carbon::parse($overtime_approval->overtime_request->date)->locale('id_ID')->translatedFormat('l, j F Y');

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.approval', compact('overtime_approval', 'today', 'manager_signature', 'employee_signature'));
        return $pdf->download('Surat Perintah Lembur - '. $overtime_approval->overtime_request->employee->user->name . ' - ' . (string)$overtime_approval->id . '.pdf');
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
    public function destroy($id)
    {
        $overtimeApproval = OvertimeApproval::find($id);
        $overtimeApproval->delete();

        return response()->json(['success' => 'Overtime approval deleted successfully'], 200);
    }

    public function approve($id)
    {
        $overtimeApproval = OvertimeApproval::find($id);

        $overtimeApproval->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);

        return response()->json(['success' => 'Overtime approval approved successfully'], 200);
    }

    public function reject($id)
    {
        $overtimeApproval = OvertimeApproval::find($id);

        $overtimeApproval->update([
            'status' => 'rejected',
        ]);

        return response()->json(['success' => 'Overtime approval rejected successfully'], 200);
    }

}