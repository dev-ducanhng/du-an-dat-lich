<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function registerForm()
    {
        return view('customer.register');
    }

    public function saveRegister(RegisterRequest $request)
    {
        $new_customer = new User();
        $new_customer->fill($request->all());
        $new_customer->password = Hash::make($request->password);
        $new_customer->status = User::ACTIVE;
        $new_customer->role_id = User::MEMBER_ROLE;
        $new_customer->save();
        return redirect()->route('login')->with('message_register_success', 'Bạn đã đăng ký tài khoản thành công!');
    }

    public function changeInformation()
    {
        $user = Auth::user();
        return view('customer.change-info', compact('user'));
    }

    public function saveChangeInformation(Request $request)
    {
        $model_user = User::find(Auth::user()->id);
        $model_user->fill($request->all());
        if ($request->hasFile('avatar')) {
            $fileUpload = $request->file('avatar');
            $fileName = Str::uuid() . $fileUpload->getClientOriginalName();
            $fileUpload->storeAs('images/users', $fileName, 'public');
            $model_user->avatar = $fileName;
        }
        $model_user->save();
        return redirect()->route('change-infomation')->with('message', 'Cập nhật thông tin thành công');
    }

    public function changePasswordForm()
    {
        $user = Auth::user();
        return view('customer.change-password', compact('user'));
    }

    public function saveNewPassword(Request $request)
    {
        dd(1);
    }
}
