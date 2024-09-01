<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = Manager::select('managers.id', 'users.name', 'users.phone_number', 'users.address', 'departments.name as department_name')
            ->join('users', 'users.id', '=', 'managers.user_id')
            ->join('departments', 'departments.id', '=', 'managers.department_id')
            ->orderBy('managers.created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Manager/Managers/Index', [
            'managers' => $managers
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
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
    }
}