<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
