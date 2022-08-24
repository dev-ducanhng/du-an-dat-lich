<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_rating', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('stylist_id');
            // $table->foreign('stylist_id')->references('id')->on('users')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            $table->unsignedBigInteger('member_id');
            // $table->foreign('member_id')->references('id')->on('users')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            $table->tinyInteger('rating')->nullable()->comment('Điểm đánh giá');
            $table->text('content')->nullable()->comment('Ghi chú');
            $table->tinyInteger('is_rating')->default(0)->comment('Đã đánh giá hay chưa? 0 là không, 1 là có.');
            $table->tinyInteger('can_edit')->default(0)->comment('Có thể sửa đánh giá được không? 0 là không, 1 là có.');

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
        Schema::dropIfExists('detail_rating');
    }
}
