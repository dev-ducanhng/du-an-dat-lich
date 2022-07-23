<?php

namespace App\Console\Commands;

use App\Models\BookingDate;
use App\Models\BookingTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedBookingTimeDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily seeder booking time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $bookingDate = BookingDate::create([
            'date' => now()->addDays(7)->toDateString(),
        ]);
        BookingTime::insert(
            [
                ['time' => '8:30', 'booking_date' => $bookingDate->id],
                ['time' => '9:00', 'booking_date' => $bookingDate->id],
                ['time' => '9:30', 'booking_date' => $bookingDate->id],
                ['time' => '10:00', 'booking_date' => $bookingDate->id],
                ['time' => '10:30', 'booking_date' => $bookingDate->id],
                ['time' => '11:00', 'booking_date' => $bookingDate->id],
                ['time' => '11:30', 'booking_date' => $bookingDate->id],
                ['time' => '12:00', 'booking_date' => $bookingDate->id],
                ['time' => '12:30', 'booking_date' => $bookingDate->id],
                ['time' => '13:00', 'booking_date' => $bookingDate->id],
                ['time' => '13:30', 'booking_date' => $bookingDate->id],
                ['time' => '14:00', 'booking_date' => $bookingDate->id],
                ['time' => '14:30', 'booking_date' => $bookingDate->id],
                ['time' => '15:00', 'booking_date' => $bookingDate->id],
                ['time' => '15:30', 'booking_date' => $bookingDate->id],
                ['time' => '16:00', 'booking_date' => $bookingDate->id],
                ['time' => '16:30', 'booking_date' => $bookingDate->id],
                ['time' => '17:00', 'booking_date' => $bookingDate->id],
                ['time' => '17:30', 'booking_date' => $bookingDate->id],
                ['time' => '18:00', 'booking_date' => $bookingDate->id],
                ['time' => '18:30', 'booking_date' => $bookingDate->id],
                ['time' => '19:00', 'booking_date' => $bookingDate->id],
            ]
        );

        return 0;
    }
}
