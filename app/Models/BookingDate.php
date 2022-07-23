<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookingDate extends Model
{
    use HasFactory;

    protected $table = 'booking_date';
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function bookingTime(): HasMany
    {
        return $this->hasMany(BookingTime::class, 'booking_date');
    }
}
