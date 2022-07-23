<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function addRole()
    {
        return view('admin.role.create');
    }

    public function postAddRole(RoleRequest $request): RedirectResponse
    {
        try {
            Role::create([
                'name' => $request->input('name')
            ]);

            return redirect()->route('dashboard.role.list');
        } catch (\Exception $message) {

            return redirect()->back()->with('message', 'Có lỗi hệ thống xảy ra, vui lòng liên hệ với quản trị viên để biết thêm chi tiết');
        }
    }

    public function getListRole()
    {
        $roles = Role::all();

        return view('admin.role.list', compact('roles'));
    }
}
