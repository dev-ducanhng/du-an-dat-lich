<style>
    .row .view-pager {
        display: none;
    }

    .btn_action {
        display: inline-flex !important;
    }
</style>

@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Danh sách bình luận</h1>
                    @if (Session::has('message'))
                        <p class="login-box-msg text-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 data-tables-hide-filter">
                    <div class="card">
                        <div class="card-body">
                            <table class="data-table data-tables-pagination responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Nội dung</th>
                                        <th>Người gửi</th>
                                        <th>Tên bài viết</th>
                                        <th>Thời gian gửi</th>
                                        <th>Trạng thái</th>
                                        <th>Chứa từ cấm</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $item)
                                        <tr>
                                            <td>
                                                <p class="list-item-heading">
                                                    {{ ($comments->currentPage() - 1) * $comments->perPage() + $loop->iteration }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="list-item-heading">
                                                    {{ strlen($item->content) > 50 ? substr($item->content, 0, 50) . '...' : $item->content }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ $item->user->name }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('detail-blog', [
                                                    'categoryPostId' => $item->post->category_post_id,
                                                    'categoryPostSlug' => $array_category_post_slug[$item->post->category_post_id],
                                                    'postId' => $item->post_id,
                                                    'postSlug' => $item->post->slug,
                                                ]) }}"
                                                    class="text-muted">{{ $item->post->title }}</a>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ date('H:i d-m-Y', strtotime($item->created_at)) }}
                                                </p>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-pill {{ $item->is_show == 0 ? 'badge-warning' : 'badge-success' }}">
                                                    {{ $item->is_show == 0 ? 'Ẩn' : 'Hiện' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-pill {{ strlen(str_replace($array_list_banned_word, '', $item->content)) != strlen($item->content) ? 'badge-warning' : 'badge-success' }}">
                                                    {{ strlen(str_replace($array_list_banned_word, '', $item->content)) != strlen($item->content) ? 'Có' : 'Không' }}
                                                </span>
                                            </td>
                                            <td class="btn_action">
                                                <a class="dropdown-item badge badge-pill badge-primary"
                                                    href="{{ route('dashboard.comment.edit', $item->id) }}">Sửa</a>
                                                <a class="dropdown-item badge badge-pill badge-danger"
                                                    href="{{ route('dashboard.comment.remove', $item->id) }}"
                                                    onClick="return confirm('Bạn muốn xóa bình luận chứ?');">Xóa </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                {{ $comments->links() }}
            </div>
        </div>
    </main>
@endsection
