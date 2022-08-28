<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Models\CommentPost;
use Illuminate\Http\Request;

class CommentPostController extends Controller
{
    public function getListComment()
    {
        $comments = CommentPost::orderBy('created_at', 'desc')->paginate(10);
        $comments->load('user', 'post');

        $category_post = CategoryPost::all();
        $array_category_post_slug = [];
        foreach ($category_post as $item) {
            $array_category_post_slug[$item['id']] = $item['slug'];
        }

        $array_list_banned_word = [
            'DM', 'Dm', 'đm',
            'ĐM', 'Đm', 'đm',
            'VCL', 'Vcl', 'vcl',
            'LON', 'Lon', 'lon',
        ];

        return view('comment.list', compact('comments', 'array_category_post_slug', 'array_list_banned_word'));
    }

    public function commentForm($id)
    {
        $comment = CommentPost::find($id);
        if (!$comment) {
            return redirect('dashboard.comment.list')->with('message', 'Không tìm thấy bình luận!');
        }

        return view('comment.edit', compact('comment'));
    }

    public function saveEdit($id, Request $request)
    {
        $comment = CommentPost::find($id);
        if (!$comment) {
            return redirect('dashboard.comment.list')->with('message', 'Không tìm thấy bình luận!');
        }
        $comment->fill($request->all());
        $comment->save();
        return redirect()->route('dashboard.comment.list')->with('message', 'Cập nhật trạng thái bình luận thành công!');
    }
}
