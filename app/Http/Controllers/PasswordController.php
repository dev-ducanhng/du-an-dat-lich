<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function formForget()
    {
        return view('auth.formReset');
    }
    public function postForget(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ], [
            'email.required' => 'Tài khoản không được để trống'
        ]);
        $token = rand(11111, 99999);
        $pos = strpos($request->emai, '@');
        if ($pos == true) {
            $email = DB::table('users')
                ->where('email', $request->email)
                ->first();
            if ($email->email == '' || $email->email == null) {
                return redirect()->back()->with('msg', 'Tài khoản chưa xác thực Enail');
            }
            if (!$email) {
                return redirect()->back()->with('msg', 'Tài khoản không chính xác');
            }
        } else {
            $email = DB::table('users')
                ->where('phone', $request->email)
                ->first();
            if ($email->email == '' || $email->email == null) {
                return redirect()->back()->with('msg', 'Tài khoản chưa xác thực Enail');
            }
            if (!$email) {
                return redirect()->back()->with('msg', 'Tài khoản không chính xác');
            }
        }

        if ($email) {
            $model = User::find($email->id);
            $model->remember_token = $token;
            $model->save();
            Mail::send('email.forgetPassword', ['token' => $token, 'email' => $email->email], function ($message) use ($email) {
                $message->to($email->email);
                $message->subject('Thông báo đổi mật khẩu');
            });
        }


        //   return redirect(route('resetPasswordConfirmation'))->with('email', $email->email);
        return redirect()->back()->with('success', 'Một thông báo đã được gửi đến địa chỉ email của bạn');
    }
    public function formReset($token, $email)
    {
        return view('auth.formPasswordReset', compact('token', 'email'));
    }
    public function saveReset(Request $request)
    {

        // var_dump($request->email);die;
        $request->validate([
            'email' => 'required',
            'remember_token' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ], [

            'password.required' => 'Mật khẩu không được trống',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
        ]);
        $updatePassword = DB::table('users')
            ->where(['email' => $request->email, 'remember_token' => $request->remember_token])
            ->first();

        if (!$updatePassword) {
            return back();
        } else {
            $user = User::find($updatePassword->id);
            $user->password =
                Hash::make($request->password);
            $user->save();
        }


        return redirect(route('login'));
    }
    public function formChange(){
        if(Auth::check()==false){
            return redirect(route('login'));
        }else{
           $user=User::find(Auth::id());
           return view('auth.changePassword');
        }
    }
    public function postChange(Request $request){
        $request->validate([
            
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ], [

            'password.required' => 'Mật khẩu không được trống',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
        ]);
        if(Auth::check()==false){
            return redirect(route('login'));
        }else{
           $user=User::find(Auth::id());
          $user->password =  Hash::make($request->password);
          $user->save();

        }
        return redirect(route('login'));
    }
}
