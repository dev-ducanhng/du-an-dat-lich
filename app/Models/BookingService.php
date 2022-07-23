<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingService extends Model
{
    use HasFactory;

    protected $table = 'booking_service';
    protected $fillable = [
        'service_id',
        'booking_id',
    ];

    /**
     * @return HasOne
     */
    public function service(): HasOne
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
