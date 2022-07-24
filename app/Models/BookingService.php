<?php

namespace App\Models;

use App\Models\Presenter\BookingPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laracasts\Presenter\PresentableTrait;

class BookingService extends Model
{
    use HasFactory, PresentableTrait;

    protected $table = 'booking_service';
    protected $fillable = [
        'service_id',
        'booking_id',
    ];
    public $presenter = BookingPresenter::class;
    /**
     * @return HasOne
     */
    public function service(): HasOne
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
