<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function getService()
    {
        $staffs = User::where('role_id', User::STAFF_ROLE)->get();
        return view('staff.index', compact('staffs'));
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
        return redirect()->route('dashboard.staff.index')->with('message', 'Thêm nhân viên mới thành công!');
    }

    public function editForm($id)
    {
        $model = User::find($id);
        return view('staff.edit', compact('model'));
    }

    public function saveEdit($id, Request $request)
    {
        $model = User::find($id);
        $model->fill($request->all());
        $model->save();
        return redirect()->route('dashboard.staff.edit', ['id' => $id])->with('message', 'Sửa thông tin nhân viên ' . $model->last_name . ' ' . $model->first_name . ' thành công!');
    }

    public function remove($id)
    {
        $model = User::find($id);
        $model_last_name = $model->last_name;
        $model_first_name = $model->first_name;
        if(!empty($model->avatar)) {
            Storage::delete($model->avatar);
        }
        $model->delete();
        return redirect()->route('dashboard.staff.index')->with('message', 'Xóa thông tin nhân viên ' . $model_last_name . ' ' . $model_first_name . ' thành công!');
    }
}
