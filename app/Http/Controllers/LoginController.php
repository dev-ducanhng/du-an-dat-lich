<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function postLogin(LoginRequest $request): RedirectResponse
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password]) && Auth::user()->role_id == User::ADMIN_ROLE) {
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->with('msg', 'Tài khoản/mật khẩu không chính xác');
        }
    }

    /**
     * @return RedirectResponse
     */
    public function logOut(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
