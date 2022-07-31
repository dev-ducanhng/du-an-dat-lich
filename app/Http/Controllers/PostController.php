<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function getListPost()
    {
        $posts = Post::all();
        $posts->load('categoryPost', 'user');
        return view('post.list', compact('posts'));
    }

    public function addPost()
    {
        $category_post = CategoryPost::all();
        return view('post.add', compact('category_post'));
    }

    public function postAddPost(PostRequest $request) {
        $model = new Post();
        $model->fill($request->all());
        $model->slug = $this->createSlugName($request->title);
        $model->user_id = Auth::id();
        if ($request->hasFile('image')) {
            $fileUpload = $request->file('image');
            $fileName = Str::uuid() . $fileUpload->getClientOriginalName();
            $fileUpload->storeAs('images/posts', $fileName, 'public');
            $model->image = $fileName;
        }
        $model->save();
        return redirect()->route('dashboard.post.list')->with('message', 'Thêm mới bài viết thành công!');
    }

    public function editPost($postId, $postSlug) {
        $post = Post::find($postId);
        if ($postSlug != $post->slug) {
            return redirect()->route('dashboard.post.list')->with('message', 'Không tìm thấy bài viết!');
        }
        $category_post = CategoryPost::all();
        return view('post.edit', compact('post', 'category_post'));
    }

    public function postEditPost($postId, $postSlug, PostRequest $request){
        $model = Post::find($postId);
        if ($postSlug != $model->slug) {
            return redirect()->route('dashboard.post.list')->with('message', 'Không tìm thấy bài viết!');
        }
        $model->fill($request->all());
        $model->slug = $this->createSlugName($request->title);
        if ($request->hasFile('image')) {
            $fileUpload = $request->file('image');
            $fileName = Str::uuid() . $fileUpload->getClientOriginalName();
            $fileUpload->storeAs('images/posts', $fileName, 'public');
            $model->image = $fileName;
        }
        $model->save();
        return redirect()->route('dashboard.post.list')->with('message', 'Sửa bài viết thành công!');
    }

    public function createSlugName($alias_url)
    {
        $search = [
            'à', 'á', 'ả', 'ã', 'ạ',
            'À', 'Á', 'Ả', 'Ã', 'Ạ',
            'ă', 'ằ', 'ắ', 'ẳ', 'ẵ', 'ặ',
            'Ă', 'Ằ', 'Ắ', 'Ẳ', 'Ẵ', 'Ặ',
            'â', 'ầ', 'ấ', 'ẩ', 'ẫ', 'ậ',
            'Â', 'Ầ', 'Ấ', 'Ẩ', 'Ẫ', 'Ậ',
            'è', 'é', 'ẻ', 'ẽ', 'ẹ',
            'È', 'É', 'Ẻ', 'Ẽ', 'Ẹ',
            'ê', 'ề', 'ế', 'ể', 'ễ', 'ệ',
            'Ê', 'Ề', 'Ế', 'Ể', 'Ễ', 'Ệ',
            'ì', 'í', 'ỉ', 'ĩ', 'ị',
            'Ì', 'Í', 'I', 'Ĩ', 'Ị',
            'ò', 'ó', 'ỏ', 'õ', 'ọ',
            'Ò', 'Ó', 'Ỏ', 'Õ', 'Ọ',
            'ô', 'ồ', 'ố', 'ổ', 'ỗ', 'ộ',
            'Ô', 'Ồ', 'Ố', 'Ổ', 'Ỗ', 'Ộ',
            'ơ', 'ờ', 'ớ', 'ở', 'ỡ', 'ợ',
            'Ơ', 'Ờ', 'Ớ', 'Ở', 'Ỡ', 'Ợ',
            'ù', 'ú', 'ủ', 'ũ', 'ụ',
            'Ù', 'Ú', 'Ủ', 'Ũ', 'Ụ',
            'ư', 'ừ', 'ứ', 'ử', 'ữ', 'ự',
            'Ư', 'Ừ', 'Ứ', 'Ử', 'Ữ', 'Ự',
            'ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ',
            'Ỳ', 'Ý', 'Ỷ', 'Ỹ', 'Ỵ'
        ];
        $replace = [
            'a', 'a', 'a', 'a', 'a',
            'a', 'a', 'a', 'a', 'a',
            'a', 'a', 'a', 'a', 'a', 'a',
            'a', 'a', 'a', 'a', 'a', 'a',
            'a', 'a', 'a', 'a', 'a', 'a',
            'a', 'a', 'a', 'a', 'a', 'a',
            'e', 'e', 'e', 'e', 'e',
            'e', 'e', 'e', 'e', 'e',
            'e', 'e', 'e', 'e', 'e', 'e',
            'e', 'e', 'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i', 'i',
            'i', 'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o',
            'o', 'o', 'o', 'o', 'o',
            'o', 'o', 'o', 'o', 'o', 'o',
            'o', 'o', 'o', 'o', 'o', 'o',
            'o', 'o', 'o', 'o', 'o', 'o',
            'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u', 'u',
            'u', 'u', 'u', 'u', 'u',
            'u', 'u', 'u', 'u', 'u', 'u',
            'u', 'u', 'u', 'u', 'u', 'u',
            'y', 'y', 'y', 'y', 'y',
            'y', 'y', 'y', 'y', 'y'
        ];
        $alias_url = str_replace($search, $replace, $alias_url);
        $divider = '-';
        // replace non letter or digits by divider
        $alias_url = preg_replace('~[^\pL\d]+~u', $divider, $alias_url);
        // transliterate
        $alias_url = iconv('utf-8', 'ASCII//TRANSLIT//IGNORE', $alias_url);
        // remove unwanted characters
        $alias_url = preg_replace('~[^-\w]+~', '', $alias_url);
        // trim
        $alias_url = trim($alias_url, $divider);
        // remove duplicate divider
        $alias_url = preg_replace('~-+~', $divider, $alias_url);
        // lowercase
        $alias_url = strtolower($alias_url);
        if (empty($alias_url)) {
            return 'n-a';
        } else {
            $array_alias_url = explode("-", $alias_url);
            if (count($array_alias_url) > 6) {
                $alias_url = $array_alias_url[0] . '-' . $array_alias_url[1] . '-' . $array_alias_url[2] . '-' . $array_alias_url[3] . '-' . $array_alias_url[4] . '-' . $array_alias_url[5];
            }
        }
        return $alias_url;
    }
}
