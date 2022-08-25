<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAddColumnsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('total_rating')->nullable()->comment('Tổng đánh giá của người dùng, với role_id là ' . User::STYLIST_ROLE);
            $table->integer('count_rating')->nullable()->comment('Tổng số lượt đánh giá của người dùng, với role_id là .' . User::STYLIST_ROLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('total_rating');
            $table->dropColumn('count_rating');
        });
    }
}
