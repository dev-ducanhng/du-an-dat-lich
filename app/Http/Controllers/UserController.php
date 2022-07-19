<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getListUser(Request $request)
    {
        $queryUser = User::with('role');
        if ($request->filled('search-key')) {
            $search = escape_like($request->input('search-key'));
            $queryUser->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE', "%{$search}%");
        }
        $users = $queryUser->paginate(10)->withQueryString();

        return view('admin.user.list-user', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function createUser()
    {
        $roles = Role::all();

        return view('admin.user.create-user', compact('roles'));
    }

    /**
     * Create user
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function postCreateUser(UserRequest $request): RedirectResponse
    {
        try {
            $fileName = '';
            if ($request->hasFile('image')) {
                $fileUpload = $request->file('image');
                $fileName = Str::uuid() . $fileUpload->getClientOriginalName();
                $fileUpload->storeAs('images/users', $fileName, 'public');
            }
            $userInputData = [
                'name'     => $request->input('name'),
                'dob'      => date('Y-m-d', strtotime($request->input('date-of-birth'))),
                'email'    => $request->input('email'),
                'phone'    => $request->input('phone'),
                'role_id'  => intval($request->input('role')),
                'gender'   => $request->input('gender'),
                'password' => Hash::make('123456'),
                'avatar'   => $fileName,
                'status'   => User::ACTIVE,
            ];
            User::create($userInputData);

            return redirect()->route('dashboard.user.list')->with('success', 'Bạn đã thêm người dùng thành công');
        } catch (\Exception $exception) {

            return redirect()->back()->withInput()->with('error', 'Có lỗi hệ thống xảy ra. Vui lòng liên hệ với quản trị viên để biết thêm chi tiết');
        }
    }

    public function editUser($userId)
    {
        $userInfo = User::find($userId);
        $roles = Role::all();

        if (! $userInfo) {
            abort(404);
        }

        return view('admin.user.edit-user', compact('userInfo', 'roles'));
    }

    /**
     * @param $userId
     * @param EditUserRequest $request
     * @return RedirectResponse
     */
    public function postEditUser($userId, EditUserRequest $request): RedirectResponse
    {
        try {
            $userInfo = User::find($userId);
            $userEditData = [
                'name'     => $request->input('name'),
                'dob'      => date('Y-m-d', strtotime($request->input('date-of-birth'))),
                'email'    => $request->input('email'),
                'phone'    => $request->input('phone'),
                'role_id'  => intval($request->input('role')),
                'gender'   => $request->input('gender'),
                'password' => Hash::make('123456'),
                'status'   => $request->input('status'),
            ];
            if ($request->hasFile('image')) {
                $fileUpload = $request->file('image');
                $fileName = Str::uuid() . $fileUpload->getClientOriginalName();
                $fileUpload->storeAs('images/users', $fileName, 'public');
                $userEditData['avatar'] = $fileName;
            }

            $userInfo->update($userEditData);

            return redirect()->route('dashboard.user.list')->with('success', 'Bạn đã cập nhật thông tin người dùng thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->with('error', 'Có lỗi hệ thống xảy ra. Vui lòng liên hệ với quản trị viên để biết thêm chi tiết');
        }
    }

    /**
     * @param $userId
     * @return RedirectResponse
     */
    public function deleteUser($userId): RedirectResponse
    {

        $userInfo = User::find($userId);
        if (! $userInfo) {
            abort(404);
        }
        User::destroy($userId);

        return redirect()->back()->with('success', 'Bạn đã xóa thông tin người dùng thành công');
    }
}
