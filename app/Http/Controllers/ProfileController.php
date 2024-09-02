<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $employee = Employee::where('user_id', $request->user()->id)->first();

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'employee' => $employee
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'phone_number' => ['string'],
            'address' => ['string', 'max:255'],
        ]);


        if($request->hasFile('signature')) {
            $fileExtension = $request->file('signature')->getClientOriginalExtension();
            $path = $request->file('signature')->storeAs(
                'public/signature/manager',
                $request->user()->name.'_'.$request->user()->id.'.'.$fileExtension
            );
            $path = str_replace('public/', 'storage/', $path);

            $request->user()->update([
                'signature' => $path
            ]);
        } else {
            return response()->json(['error' => "File gambar tidak terdeteksi"]);
        }

        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        // update employee data
        Employee::where('user_id', $request->user()->id)->update([
            'position' => $request->position
        ]);

        return response()->json(['success' => "Data berhasil diupdate"]);

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
