<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user is an employee (has manager_id means they are an employee)
        if ($user && $user->employee && !is_null($user->employee->manager_id)) {
            return $next($request);
        }

        // Redirect the user if they are not an employee
        return redirect()->route('home')->with('error', 'Access denied.');
    }
}
