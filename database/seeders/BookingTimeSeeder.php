<?php

namespace Database\Seeders;

use App\Models\BookingDate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTimes = BookingDate::whereBetween('date', [now()->toDateString(), now()->addDays(6)->toDateString()])->get();
        foreach ($dateTimes as $dateTime) {
            $time = [
                ['time' => '8:30', 'booking_date' => $dateTime->id],
                ['time' => '9:00', 'booking_date' => $dateTime->id],
                ['time' => '9:30', 'booking_date' => $dateTime->id],
                ['time' => '10:00', 'booking_date' => $dateTime->id],
                ['time' => '10:30', 'booking_date' => $dateTime->id],
                ['time' => '11:00', 'booking_date' => $dateTime->id],
                ['time' => '11:30', 'booking_date' => $dateTime->id],
                ['time' => '12:00', 'booking_date' => $dateTime->id],
                ['time' => '12:30', 'booking_date' => $dateTime->id],
                ['time' => '13:00', 'booking_date' => $dateTime->id],
                ['time' => '13:30', 'booking_date' => $dateTime->id],
                ['time' => '14:00', 'booking_date' => $dateTime->id],
                ['time' => '14:30', 'booking_date' => $dateTime->id],
                ['time' => '15:00', 'booking_date' => $dateTime->id],
                ['time' => '15:30', 'booking_date' => $dateTime->id],
                ['time' => '16:00', 'booking_date' => $dateTime->id],
                ['time' => '16:30', 'booking_date' => $dateTime->id],
                ['time' => '17:00', 'booking_date' => $dateTime->id],
                ['time' => '17:30', 'booking_date' => $dateTime->id],
                ['time' => '18:00', 'booking_date' => $dateTime->id],
                ['time' => '18:30', 'booking_date' => $dateTime->id],
                ['time' => '19:00', 'booking_date' => $dateTime->id],
            ];
            DB::table('booking_time')->insert($time);
        }
    }
}
