<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'price',
        'name',
        'discount',
        'status',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
