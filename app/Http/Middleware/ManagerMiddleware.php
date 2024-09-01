<?php

namespace App\Http\Middleware;

use Closure;
use Inertia\Inertia;
use App\Models\Manager;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
        if(Manager::where('user_id', $user->id)->exists()) {
            return $next($request);
        }
        if (Employee::where('user_id', $user->id)->exists()) {
            $toastList = [
                [
                    'type' => 'danger',
                    'message' => 'You are not allowed to access manager dashboard'
                ]
            ];

            return redirect()->route('dashboard')->with('ToastList', $toastList);
        }
    }
}