<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    const SOLVED = 0;
    const SOLVED_YET = 1;
    const MULTIPLE = 1;
    const SINGLE = 0;
    const PAYMENT_WITH_CARD = 1;
    const PAYMENT_WITH_CASH = 0;

    protected $table = 'bookings';
    protected $guarded = ['id'];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasMany
     */
    public function bookingService(): HasMany
    {
        return $this->hasMany(BookingService::class, 'booking_id');
    }

    /**
     * @return HasOne
     */
    public function bookingDate(): HasOne
    {
        return $this->hasOne(BookingDate::class, 'id', 'booking_date');
    }
}
