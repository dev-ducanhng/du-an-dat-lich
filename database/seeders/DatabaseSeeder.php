<?php

namespace Database\Seeders;

use App\Models\BookingDate;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //BookingDate
        $periodRange = CarbonPeriod::create(now()->toDateString(), now()->addDays(6)->toDateString());
        $periodDate = [];
        foreach ($periodRange as $date) {
            $periodDate[] = $date->format('Y-m-d');
        }
        foreach ($periodDate as $importDate) {
            BookingDate::create([
                'date' => $importDate,
            ]);
        }

        //BookingTime
        $dateTimes = BookingDate::whereBetween('date', [now()->toDateString(), now()->addDays(6)->toDateString()])->get();
        foreach ($dateTimes as $dateTime) {
            $time = [
                ['time' => '8:30', 'booking_date' => $dateTime->id],
                ['time' => '9:00', 'booking_date' => $dateTime->id],
                ['time' => '9:30', 'booking_date' => $dateTime->id],
                ['time' => '10:00', 'booking_date' => $dateTime->id],
                ['time' => '10:30', 'booking_date' => $dateTime->id],
                ['time' => '11:00', 'booking_date' => $dateTime->id],
                ['time' => '11:30', 'booking_date' => $dateTime->id],
                ['time' => '12:00', 'booking_date' => $dateTime->id],
                ['time' => '12:30', 'booking_date' => $dateTime->id],
                ['time' => '13:00', 'booking_date' => $dateTime->id],
                ['time' => '13:30', 'booking_date' => $dateTime->id],
                ['time' => '14:00', 'booking_date' => $dateTime->id],
                ['time' => '14:30', 'booking_date' => $dateTime->id],
                ['time' => '15:00', 'booking_date' => $dateTime->id],
                ['time' => '15:30', 'booking_date' => $dateTime->id],
                ['time' => '16:00', 'booking_date' => $dateTime->id],
                ['time' => '16:30', 'booking_date' => $dateTime->id],
                ['time' => '17:00', 'booking_date' => $dateTime->id],
                ['time' => '17:30', 'booking_date' => $dateTime->id],
                ['time' => '18:00', 'booking_date' => $dateTime->id],
                ['time' => '18:30', 'booking_date' => $dateTime->id],
                ['time' => '19:00', 'booking_date' => $dateTime->id],
            ];
            DB::table('booking_time')->insert($time);
        }

        //CategoryPost
        $category_post_default = [
            [
                'name' => 'Khuyến mãi',
                'slug' => 'khuyen-mai'
            ],
            [
                'name' => 'Hướng dẫn sử dụng',
                'slug' => 'huong-dan-su-dung'
            ],
            [
                'name' => 'Thời trang tóc',
                'slug' => 'thoi-trang-toc'
            ],
            [
                'name' => 'Phụ kiến',
                'slug' => 'phu-kien'
            ],
        ];
        DB::table('category_post')->insert($category_post_default);

        //Discount
        $discounts_default = [
            [
                'name' => 'Vouncher cho khách hàng mới đăng ký tháng ' . date('m') . ' năm ' . date('Y'),
                'code_discount' => 'NGUOIMOI',
                'percent' => 10,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime(date('Y-m-d') . "+30 day")),
            ],
        ];
        DB::table('discounts')->insert($discounts_default);

        //Role
        $roles_default = [
            ['name' => 'Admin'],
            ['name' => 'Stylish'],
            ['name' => 'Nhân viên'],
            ['name' => 'Khách hàng'],
        ];
        DB::table('roles')->insert($roles_default);

        //Users
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

        //Service
        $services_default = [
            [
                'name' => 'Cắt tóc thông thường',
                'price' => 50000,
                'discount' => 0,
                'status' => 1,
            ],
        ];
        DB::table('services')->insert($services_default);
    }
}
