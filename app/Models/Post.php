<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'category_post_id', 'status', 'view'];

    public function categoryPost() {
        return $this->hasOne(CategoryPost::class, 'id', 'category_post_id');
    }
}
