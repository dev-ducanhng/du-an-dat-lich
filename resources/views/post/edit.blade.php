<script type="text/javascript">
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container">
            <h5 class="mb-5">Sửa bài viết {{ $post->title }}</h5>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" id="form-add-post" method="POST" enctype="multipart/form-data"
                        class="row needs-validation tooltip-label-right">
                        @csrf
                        <div class="col-4">
                            <div class="form-group position-relative error-l-50">
                                <label>Ảnh</label>
                                <input type="file" accept="image/*" id="file" onchange="loadFile(event)"
                                    name="image" class="input-sm form-control">
                                <img src="{{ asset('storage/images/posts/' . $post->image) }}" id="output"
                                    class="mt-2 rounded-circle" width="100%" />
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group position-relative error-l-50">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" id="title" value="{{ $post->title }}"
                                    class="input-sm form-control">
                                @error('title')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group position-relative error-l-50">
                                <label>Danh mục bài viết</label>
                                <select name="category_post_id" class="form-control select2-single" data-width="100%">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($category_post as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == $post->category_post_id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_post_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group position-relative error-l-50">
                                <label>Nội dung</label>
                                <textarea name="content" class="form-control" rows="10">{{ $post->content }}</textarea>
                                @error('content')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group position-relative error-l-50">
                                <label>Trạng thái bài viết</label>
                                <select name="status" class="form-control select2-single" data-width="100%">
                                    <option value="1" @if ($post->status == 1) selected @endif>Hiện</option>
                                    <option value="0" @if ($post->status == 0) selected @endif>Ẩn</option>
                                </select>
                                @error('status')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-0">Cập nhật bài viết</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
