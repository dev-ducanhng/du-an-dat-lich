<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteQuantityBookingService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('booking_service', 'quantity')) {
            Schema::table('booking_service', function (Blueprint $table) {
                $table->dropColumn('quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('booking_service', 'quantity')) {
            Schema::table('booking_service', function (Blueprint $table) {
                $table->dropColumn('quantity');
            });
        }
    }
}
