<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;

use function Flasher\Toastr\Prime\toastr;
use function Laravel\Prompts\error;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::select('employees.id', 'users.name', 'users.phone_number', 'users.address', 'departments.name as department_name', 'employees.position')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->orderBy('employees.created_at', 'desc')
            ->paginate(10);

        // $departments = Department::all();

        return Inertia::render('Manager/Employees/Index', [
            'employees' => $employees,
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
    public function store(EmployeeRequest $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
            'department_id' => ['required'],
            'position' => ['required'],
        ]);

        if ($validated) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

            Employee::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'position' => $request->position,
            ]);

            return response()->json(['success' => 'Employee created successfully'], 200);
        }

        return response()->json(['message' => 'Failed to create employee'], 500);
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();

            User::where('id', $employee->user_id)->delete();

            return response()->json(['success' => 'Employee deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete employee'], 500);
    }
}