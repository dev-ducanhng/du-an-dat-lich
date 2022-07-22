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
                'status' => User::ACTIVE,
                'role_id' => User::ADMIN_ROLE,
            ],
        ];

        DB::table('users')->insert($users_default);
    }
}
