<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRating extends Model
{
    use HasFactory;

    const RATED_YET = 0;
    const RATED = 1;

    const CANNOT_EDIT = 0;
    const CAN_EDIT = 1;

    protected $table = 'detail_rating';
    protected $fillable = [
        'stylist_id',
        'member_id',
        'rating',
        'content',
        'is_rating',
        'can_edit',
    ];
}
