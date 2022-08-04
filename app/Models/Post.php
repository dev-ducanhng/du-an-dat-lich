<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_post_id',
        'user_id',
        'status',
        'view',
    ];

    public function categoryPost()
    {
        return $this->hasOne(CategoryPost::class, 'id', 'category_post_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
