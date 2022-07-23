<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTime extends Model
{
    use HasFactory;
    const ACTIVE_STATUS = 0;
    const INACTIVE_STATUS = 1;
    protected $table = 'booking_time';
    protected $guarded = ['id'];
}
