<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_default = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '0385241997',
                'password' => Hash::make('12345678'),
                'gender' => User::MALE,
                'dob' => date('Y-m-d'),
                'avatar' => 'users/user-default-avatar.jpg',
                'status' => User::ACTIVE,
                'role_id' => User::ADMIN_ROLE,
            ],
            [
                'name' => 'Nguyễn Tài Duy',
                'email' => 'td.nguyen.1997@gmail.com',
                'phone' => '0399089824',
                'password' => Hash::make('02091997'),
                'gender' => User::MALE,
                'dob' => '1997-09-02',
                'avatar' => 'users/user-default-avatar.jpg',
                'status' => User::ACTIVE,
                'role_id' => User::ADMIN_ROLE,
            ],
            [
                'name' => 'Văn Đình Huy',
                'email' => 'vandinhhuy@gmail.com',
                'phone' => '0981111111',
                'password' => Hash::make('12345678'),
                'gender' => User::MALE,
                'dob' => '2000-01-01',
                'avatar' => 'users/user-default-avatar.jpg',
                'status' => User::ACTIVE,
                'role_id' => User::STYLIST_ROLE,
            ],
            [
                'name' => 'Nguyễn Đức Anh',
                'email' => 'nguyenducanh@gmail.com',
                'phone' => '0982222222',
                'password' => Hash::make('12345678'),
                'gender' => User::MALE,
                'dob' => '1998-12-31',
                'avatar' => 'users/user-default-avatar.jpg',
                'status' => User::ACTIVE,
                'role_id' => User::STYLIST_ROLE,
            ],
            [
                'name' => 'Phạm Thị Thanh',
                'email' => 'phamthithanh@gmail.com',
                'phone' => '0983333333',
                'password' => Hash::make('12345678'),
                'gender' => User::FEMALE,
                'dob' => '2000-12-11',
                'avatar' => 'users/user-default-avatar.jpg',
                'status' => User::ACTIVE,
                'role_id' => User::MEMBER_ROLE,
            ],
            [
                'name' => 'Nguyễn Anh Tuấn',
                'email' => 'nguyenanhtuan@gmail.com',
                'phone' => '0984444444',
                'password' => Hash::make('12345678'),
                'gender' => User::MALE,
                'dob' => '1999-12-11',
                'avatar' => 'users/user-default-avatar.jpg',
                'status' => User::ACTIVE,
                'role_id' => User::MEMBER_ROLE,
            ],
        ];

        DB::table('users')->insert($users_default);
    }
}
