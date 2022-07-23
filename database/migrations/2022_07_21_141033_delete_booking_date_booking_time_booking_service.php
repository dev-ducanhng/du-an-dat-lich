<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteBookingDateBookingTimeBookingService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('booking_service', 'booking_time')) {
            Schema::table('booking_service', function (Blueprint $table) {
                $table->dropColumn('booking_time');
            });
        }
    }
}
