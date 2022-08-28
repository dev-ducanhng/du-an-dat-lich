<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Models\CategoryPost;
use App\Models\CommentPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function getListPost()
    {
        $posts = Post::paginate(10);
        $posts->load('categoryPost', 'user');
        return view('post.list', compact('posts'));
    }

    public function addPost()
    {
        $category_post = CategoryPost::all();
        return view('post.add', compact('category_post'));
    }

    public function postAddPost(PostRequest $request)
    {
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

    public function editPost($postId, $postSlug)
    {
        $post = Post::find($postId);
        if ($postSlug != $post->slug) {
            return redirect()->route('dashboard.post.list')->with('message', 'Không tìm thấy bài viết!');
        }
        $category_post = CategoryPost::all();
        return view('post.edit', compact('post', 'category_post'));
    }

    public function postEditPost($postId, $postSlug, PostRequest $request)
    {
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

    public function getNewestBlog()
    {
        $category_post = CategoryPost::all();
        $category_post->load('posts');
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->paginate(6);
        $posts->load('categoryPost', 'user');
        return view('post.blog', compact('category_post', 'posts'));
    }

    public function getCategoryBlog($categoryPostId, $categoryPostSlug)
    {
        $category_post = CategoryPost::find($categoryPostId);
        $other_category_post = CategoryPost::where('id', '!=', $categoryPostId)->get();
        $other_category_post->load('posts');
        if ($categoryPostSlug != $category_post->slug) {
            return redirect()->route('blog')->with('message', 'Không tìm thấy danh mục bài viết!');
        }
        $posts_by_category = Post::where('category_post_id', $categoryPostId)->orderBy('created_at', 'desc')->paginate(6);
        $posts_by_category->load('categoryPost', 'user');
        return view('post.blog-category', compact('category_post', 'other_category_post', 'posts_by_category'));
    }

    public function detailBlog($categoryPostId, $categoryPostSlug, $postId, $postSlug)
    {
        $category_post = CategoryPost::find($categoryPostId);
        $other_post_most_view = Post::where('id', '!=', $postId)->orderBy('view', 'desc')->limit(5)->get();
        $other_post_by_category_id = Post::where('id', '!=', $postId)->where('category_post_id', $categoryPostId)->limit(5)->get();

        $post = Post::find($postId);
        if ($categoryPostSlug != $category_post->slug) {
            return redirect()->route('blog')->with('message', 'Không tìm thấy danh mục bài viết!');
        }
        if ($postSlug != $post->slug) {
            return redirect()->route('blog')->with('message', 'Không tìm thấy bài viết!');
        }
        if ($categoryPostId != $post->category_post_id) {
            return redirect()->route('blog')->with('message', 'Không tìm thấy bài viết nào thuộc danh mục!');
        }
        if (Auth::check()) {
            $post->view++;
            $post->save();
        }
        $post->load('categoryPost', 'user');

        $comment_by_post = CommentPost::where('post_id', $postId)->where('is_show', 1)->orderBy('created_at', 'desc')->get();
        $comment_by_post->load('user', 'post');

        return view('post.detail-blog', compact(
            'category_post',
            'other_post_most_view',
            'other_post_by_category_id',
            'post',
            'comment_by_post',
        ));
    }

    public function sendComment(CommentRequest $request)
    {
        $post = Post::find($request->post_id);
        $category_post = $post->category_post_id;
        $category_post_slug = CategoryPost::find($category_post)->slug;
        $post_id = $request->post_id;
        $post_slug = $post->slug;

        $model_comment = new CommentPost();
        $model_comment->fill($request->all());

        $array_list_banned_word = [
            'DIT', 'Dit', 'dit',
            'DM', 'Dm', 'đm',
            'ĐM', 'Đm', 'đm',
            'VCL', 'Vcl', 'vcl',
            'LON', 'Lon', 'lon',
        ];
        if (strlen(str_replace($array_list_banned_word, '', $request->content)) != strlen($request->content)) {
            $model_comment->is_show = CommentPost::HIDDEN;
        } else {
            $model_comment->is_show = CommentPost::SHOW;
        }
        $model_comment->save();

        return redirect()->route('detail-blog', [
            'categoryPostId' => $category_post,
            'categoryPostSlug' => $category_post_slug,
            'postId' => $post_id,
            'postSlug' => $post_slug,
        ]);
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

    public static function limitWords($string, $maxOut)
    {
        if ($string == '')
            return '';
        $string2Array = explode(' ', $string, ($maxOut + 1));

        if (count($string2Array) > $maxOut) {
            array_pop($string2Array);
            $output = implode(' ', $string2Array) . ' ...';
        } else {
            $output = $string;
        }

        return $output;
    }
}
