<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $login = $request->input('login');
        $password = $request->input('password');
        $credentials = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? ['email' => $login, 'password' => $password]
            : ['phone' => $login, 'password' => $password];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->employee && is_null(optional($user->employee)->manager_id)) {
                return redirect()->route('home');
            } else {
                return redirect()->route('my_tasks', optional($user->employee)->id);
            }
        }
        toastr()->error(__('auth.failed'));
        return back()->withInput();
    }

    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
