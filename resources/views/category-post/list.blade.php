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
                    <h1>Danh sách danh mục bài viết</h1>
                    @if (Session::has('message'))
                        <p class="login-box-msg text-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="text-zero top-right-button-container">
                        <a href="{{ route('dashboard.category-post.create') }}"
                            class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm danh mục bài viết</a>
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
                                        <th>Tên danh mục bài viết</th>
                                        <th>Đường dẫn</th>
                                        <th>Số lượng bài viết</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category_post as $key => $item)
                                        <tr>
                                            <td>
                                                <p class="list-item-heading">
                                                    {{ ($category_post->currentPage() - 1) * $category_post->perPage() + $loop->iteration }}
                                                </p>
                                            </td>
                                            <td>
                                                <a href="{{ route('blog-category', [
                                                    'categoryPostId' => $item->id,
                                                    'categoryPostSlug' => $item->slug,
                                                ]) }}" target="_blank"
                                                    class="w-40 w-sm-100">
                                                    <p class="list-item-heading mb-0 truncate">{{ $item->name }}</p>
                                                </a>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ $item->slug }}</p>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ count($item->posts) }}</p>
                                            </td>
                                            <td>
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.category-post.edit', $item->id) }}">
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
                {{ $category_post->links() }}
            </div>
        </div>
    </main>
@endsection
