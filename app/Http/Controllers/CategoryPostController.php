<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPostRequest;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function getListCategoryPost()
    {
        $category_post = CategoryPost::all();
        $category_post->load('posts');
        return view('category-post.list', compact('category_post'));
    }

    public function addCategoryPost()
    {
        return view('category-post.add');
    }

    public function postAddCategoryPost(CategoryPostRequest $request)
    {
        $model = new CategoryPost();
        $model->fill($request->all());
        $model->slug = $this->createSlugName($request->name);
        $model->save();
        return redirect()->route('dashboard.category-post.list')->with('message', 'Thêm mới danh mục bài viết thành công!');
    }

    public function editCategoryPost($categoryPostId)
    {
        $category_post = CategoryPost::find($categoryPostId);
        if (!$category_post) {
            return redirect()->route('dashboard.category-post.list')->with('message', 'Không tìm thấy danh mục bài biết mà bạn chọn!');
        }
        return view('category-post.edit', compact('category_post'));
    }

    public function postEditCategoryPost($categoryPostId, CategoryPostRequest $request)
    {
        $category_post = CategoryPost::find($categoryPostId);
        if (!$category_post) {
            return redirect()->route('dashboard.category-post.list')->with('message', 'Không tìm thấy danh mục bài biết mà bạn chọn!');
        }
        $category_post->fill($request->all());
        $category_post->slug = $this->createSlugName($request->name);
        $category_post->save();
        return redirect()->route('dashboard.category-post.list')->with('message', 'Sửa danh mục bài viết thành công!');
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
