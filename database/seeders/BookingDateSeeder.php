<?php

namespace Database\Seeders;

use App\Models\BookingDate;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class BookingDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodRange = CarbonPeriod::create(now()->toDateString(), now()->addDays(6)->toDateString());
        $periodDate = [];
        foreach ($periodRange as $date) {
            $periodDate[] = $date->format('Y-m-d');
        }
        foreach ($periodDate as $importDate) {
            BookingDate::create([
                'date' => $importDate,
            ]);
        }
    }
}
