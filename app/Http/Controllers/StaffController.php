<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function getService()
    {
        $staffs = User::where('role_id', User::STAFF_ROLE)->get();
        dd($staffs);
    }

    public function addForm()
    {
        return view('staff.add');
    }

    public function saveAdd(Request $request)
    {
        $staff = new User();
        $staff->fill($request->all());
        $staff->password = Hash::make('12345678');
        $staff->role_id = User::STAFF_ROLE;
        $staff->save();

        return redirect()->route('staff.index')->with('message', 'Thêm nhân viên mới thành công!');
    }
}
