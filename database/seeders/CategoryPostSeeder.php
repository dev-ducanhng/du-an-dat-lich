<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
