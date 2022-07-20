<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // if (strlen(strstr($email, '@')) > 0) {
        //     $request->validate(
        //         [
        //             'email' => 'required',
        //             'password' => 'required'
        //         ],
        //         [
        //             'email.required' => "Hãy nhập email hoặc số điện thoại",
                  
        //             "password.required" => "Hãy nhập mật khẩu"
        //         ]
    
        //     );
        // }
       


        if (strlen(strstr($email, '@')) > 0) {
            if (Auth::attempt(['email' => $email, 'password' => $password], $request->remember)) {

                return redirect(route('service.index'));
            }
        } else {
            if (Auth::attempt(['phone' => $email, 'password' => $password], $request->remember)) {

                return redirect(route('service.index'));
            }
        }
        return back()->with('msg', 'Tài khoản/mật khẩu không chính xác');
        
    }
}
