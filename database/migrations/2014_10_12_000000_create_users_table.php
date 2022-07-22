<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('Tên người dùng');
            $table->string('email')->unique()->comment('Email người dùng');
            $table->string('phone')->unique()->comment('Số điện thoại người dùng');
            $table->string('password')->comment('Mật khẩu');
            $table->tinyInteger('gender')->nullable()->comment('Giới tính: 1 là Nam/2 là Nữ');
            $table->date('dob')->nullable()->comment('Ngày sinh');
            $table->string('avatar')->nullable()->comment('Đường dẫn ảnh');
            $table->tinyInteger('status')->default(0)->comment('Trạng thái tài khoản: 0 là hoạt động/1 là không hoạt động');
            $table->unsignedBigInteger('role_id')->default(4)->comment('Chức vụ của tải khoản: 1 là Admin/2 là Stylish/3 là Nhân viên/4 là Khách hàng');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
