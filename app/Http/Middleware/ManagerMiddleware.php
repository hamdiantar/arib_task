<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
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
        if ($user && $user->employee && is_null($user->employee->manager_id)) {
            return $next($request);
        }
        // Redirect the user if they are not a manager
        return redirect()->route('my_tasks')->with('error', 'Access denied.');
    }
}
