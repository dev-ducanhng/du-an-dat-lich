<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPostRequest;
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

    public function postAddCategoryPost(CategoryPostRequest $request) {
        $model = new CategoryPost();
        $model->fill($request->all());
        $model->save();
        return redirect()->route('dashboard.category-post.list')->with('message', 'Thêm mới danh mục bài viết thành công!');
    }

    public function editCategoryPost($categoryPostId) {
        $category_post = CategoryPost::find($categoryPostId);
        if (!$category_post) {
            return redirect()->route('dashboard.category-post.list')->with('message', 'Không tìm thấy danh mục bài biết mà bạn chọn!');
        }
        return view('category-post.edit', compact('category_post'));
    }

    public function postEditCategoryPost($categoryPostId, CategoryPostRequest $request) {
        $category_post = CategoryPost::find($categoryPostId);
        if (!$category_post) {
            return redirect()->route('dashboard.category-post.list')->with('message', 'Không tìm thấy danh mục bài biết mà bạn chọn!');
        }
        $category_post->fill($request->all());
        $category_post->save();
        return redirect()->route('dashboard.category-post.list')->with('message', 'Sửa danh mục bài viết thành công!');
    }
}
