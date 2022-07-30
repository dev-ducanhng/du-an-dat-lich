@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h1>Danh sách bài viết</h1>
                        <div class="text-zero top-right-button-container">
                            <a href="{{ route('dashboard.post.create') }}"
                                class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm bài viết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 list" data-check-all="checkAll">
                    @foreach ($posts as $item)
                        <div class="card d-flex flex-row mb-3">
                            <a class="d-flex" href="javascript:;">
                                <img src="" alt="Fat Rascal"
                                    class="list-thumbnail responsive border-0 card-img-left" />
                            </a>
                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a href="javascript:;" class="w-40 w-sm-100">
                                        <p class="list-item-heading mb-0 truncate">{{ $item->title }}</p>
                                    </a>
                                    <p class="mb-0 text-muted text-small w-15 w-sm-100">{{ $item->categoryPost->name }}</p>
                                    <p class="mb-0 text-muted text-small w-15 w-sm-100">{{ $item->created_at }}</p>
                                    <div class="w-15 w-sm-100">
                                        @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Hiện</span>
                                        @elseif ($item->status == 0)
                                            <span class="badge badge-pill badge-danger">Ẩn</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
