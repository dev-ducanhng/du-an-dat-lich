<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->comment('Tiêu đề bài viết');
            $table->string('slug', 50)->comment('Slug của bài viết');
            $table->string('image')->nullable()->comment('Đường dẫn ảnh');
            $table->text('content')->comment('Nội dung bài viết');

            $table->unsignedBigInteger('category_post_id')->comment('ID danh mục bài viết');
            $table->foreign('category_post_id')->references('id')->on('category_post')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->comment('ID người đăng bài');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('status')->default(0)->comment('Trạng thái bài viết: 0 là ẩn/1 là hiện');
            $table->integer('view')->default(0)->comment('Số lượt xem bài viết');
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
        Schema::dropIfExists('posts');
    }
}
