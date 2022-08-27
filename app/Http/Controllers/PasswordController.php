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
            'email.required' => 'Tài khoản không được để trống',
        ]);
        $token = rand(11111, 99999);
        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();
        if ($user && ($user->email == '' || $user->email == null)) {
            return redirect()->back()->with('msg', 'Tài khoản chưa xác thực Enail');
        }
        if (! $user) {
            return redirect()->back()->with('msg', 'Tài khoản không chính xác');
        } else if ($user) {
            $model = User::find($user->id);
            $model->remember_token = $token;
            $model->save();
            Mail::send('email.forgetPassword', ['token' => $token, 'email' => $user->email], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Thông báo đổi mật khẩu');
            });
        }

        return redirect()->back()->with('success', 'Email thay đổi mật khẩu đã được gửi đến tài khoản của bạn. Vui lòng kiểm tra email để tiến hành reset mật khẩu.');
    }

    public function formReset($token, $email)
    {
        return view('auth.formPasswordReset', compact('token', 'email'));
    }

    public function saveReset(Request $request)
    {

        $request->validate([
            'email'                 => 'required',
            'remember_token'        => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [

            'password.required'              => 'Mật khẩu không được trống',
            'password.min'                   => 'Mật khẩu tối thiểu 6 kí tự',
            'password.confirmed'             => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
        ]);
        $updatePassword = DB::table('users')
            ->where(['email' => $request->email, 'remember_token' => $request->remember_token])
            ->first();

        if (! $updatePassword) {
            return back();
        } else {
            $user = User::find($updatePassword->id);
            $user->password =
                Hash::make($request->password);
            $user->save();
        }


        return redirect(route('login'))->with('mess', 'Vui lòng đăng nhập lại');
    }

    public function formChange()
    {
        if (Auth::check() == false) {
            return redirect(route('login'));
        } else {
            $user = User::find(Auth::id());
            return view('auth.changePassword', compact('user'));
        }
    }

    public function postChange(Request $request)
    {
        $request->validate([
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [

            'password.required'              => 'Mật khẩu không được trống',
            'password.min'                   => 'Mật khẩu tối thiểu 6 kí tự',
            'password.confirmed'             => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
        ]);
        if (Auth::check() == false) {
            return redirect(route('login'));
        } else {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
        }
        return redirect(route('login'));
    }
}
