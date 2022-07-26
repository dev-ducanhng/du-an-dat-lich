<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function getListCategoryPost() {
        $category_post = CategoryPost::all();
        $category_post->load('posts');
        return view('category-post.list', compact('category_post'));
    }

    public function addCategoryPost() {
        return view('category-post.add');
    }
}
