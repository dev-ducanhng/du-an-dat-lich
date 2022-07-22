<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên phản hồi');
            $table->string('phone_number')->nullable()->comment('Số điện thoại');
            $table->text('content')->comment('Nội dung phản hồi');
            $table->string('image')->nullable()->comment('Đường dẫn ảnh');
            $table->tinyInteger('rating')->nullable()->comment('Điểm đánh giá');
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
        Schema::dropIfExists('feedbacks');
    }
}
