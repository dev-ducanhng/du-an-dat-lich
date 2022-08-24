<?php

namespace App\Models;

use App\Models\Presenter\BookingPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laracasts\Presenter\PresentableTrait;

class Booking extends Model
{
    use HasFactory, PresentableTrait;

    const SOLVED = 0;
    const SOLVED_YET = 1;
    const CANCEL = 2;

    const MULTIPLE = 1;
    const SINGLE = 0;
    const PAYMENT_WITH_CARD = 1;
    const PAYMENT_WITH_CASH = 0;
    const BOOKING_SUCCESS = 1;
    const BOOKING_FAILED = 0;
    const PAYMENT_SUCCESS = 1;
    const PAYMENT_YET = 0;

    protected $table = 'bookings';
    protected $guarded = ['id'];
    public $presenter = BookingPresenter::class;

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

    /**
     * @return HasOne
     */
    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    /**
     * @return HasOne
     */
    public function stylist(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'stylist');
    }
    /**
     * @return HasOne
     */
    public function stylistInfo(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'stylist');
    }
}
