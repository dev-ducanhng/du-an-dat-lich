<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts_default = [
            [
                'name' => 'Vouncher cho khách hàng mới đăng ký tháng ' . date('m') . ' năm ' . date('Y') ,
                'code_discount' => 'NGUOIMOI',
                'percent' => 10,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime(date('Y-m-d') . "+30 day")),
            ],
        ];

        DB::table('discounts')->insert($discounts_default);
    }
}
