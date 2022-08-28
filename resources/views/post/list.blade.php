<style>
    .row .view-pager {
        display: none;
    }
</style>

@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Danh sách bài viết</h1>
                    @if (Session::has('message'))
                        <p class="login-box-msg text-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="text-zero top-right-button-container">
                        <a href="{{ route('dashboard.post.create') }}"
                            class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm bài viết</a>
                    </div>
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
                                        <th>Tiêu đề</th>
                                        <th>Slug</th>
                                        <th>Ảnh</th>
                                        <th>Người đăng bài</th>
                                        <th>Danh mục</th>
                                        <th>Lượt xem</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đăng bài</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $item)
                                        <tr>
                                            <td>
                                                <p class="list-item-heading">
                                                    {{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}
                                                </p>
                                            </td>
                                            <td>
                                                <a href="{{ route('detail-blog', [
                                                    'categoryPostId' => $item->categoryPost->id,
                                                    'categoryPostSlug' => $item->categoryPost->slug,
                                                    'postId' => $item->id,
                                                    'postSlug' => $item->slug,
                                                ]) }}" target="_blank"
                                                    class="w-40 w-sm-100">
                                                    <p class="list-item-heading mb-0 truncate">{{ $item->title }}</p>
                                                </a>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ $item->slug }}</p>
                                            </td>
                                            <td>
                                                <a class="d-flex" href="javascript:;">
                                                    <img src="{{ asset('storage/images/posts/' . $item->image) }}"
                                                        alt="Fat Rascal"
                                                        class="list-thumbnail responsive border-0 card-img-left" />
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="w-40 w-sm-100">
                                                    <p class="list-item-heading mb-0 truncate">{{ $item->user->name }}</p>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('blog-category', [
                                                    'categoryPostId' => $item->categoryPost->id,
                                                    'categoryPostSlug' => $item->categoryPost->slug,
                                                ]) }}" target="_blank"
                                                    class="w-40 w-sm-100">
                                                    <p class="list-item-heading mb-0 truncate">{{ $item->categoryPost->name }}</p>
                                                </a>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ $item->view . ' lượt xem' }}</p>
                                            </td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-pill badge-success">Hiện</span>
                                                @elseif ($item->status == 0)
                                                    <span class="badge badge-pill badge-danger">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-muted">
                                                    {{ date('H:i:s d/m/Y', strtotime($item->created_at)) }}</p>
                                            </td>
                                            <td>
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.post.edit', ['postId' => $item->id, 'postSlug' => $item->slug]) }}">
                                                    <i class="iconsminds-pen-2"></i>Sửa
                                                </a>
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
                {{ $posts->links() }}
            </div>
        </div>
    </main>
@endsection
