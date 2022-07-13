<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request){
        // validate dữ liệu
       
        $email = $request->email;
        $password = $request->password;
        if (strlen(strstr($email, '@')) > 0) {
            if(Auth::attempt(['email' => $email, 'password' => $password], $request->remember)){
            
                return redirect(route('service.index'));
            }
            }
            else{
                if(Auth::attempt(['phone' => $email, 'password' => $password], $request->remember)){
            
                    return redirect(route('service.index'));
                }
            }
      
        return back()->with('msg', 'Tài khoản/mật khẩu không chính xác');
    }
}
