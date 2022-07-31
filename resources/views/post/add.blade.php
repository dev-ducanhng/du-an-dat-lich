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
            <h5 class="mb-5">Thêm mới bài viết</h5>
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
                                <img id="output" class="mt-2 rounded-circle" width="100%" />
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group position-relative error-l-50">
                                <label>Tiêu đề</label>
                                <input type="text" name="title" id="title" class="input-sm form-control">
                                @error('title')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group position-relative error-l-50">
                                <label>Danh mục bài viết</label>
                                <select name="category_post_id" class="form-control select2-single" data-width="100%">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($category_post as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_post_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group position-relative error-l-50">
                                <label>Nội dung</label>
                                <textarea name="content" class="form-control" rows="10"></textarea>
                                @error('content')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group position-relative error-l-50">
                                <label>Trạng thái bài viết</label>
                                <select name="status" class="form-control select2-single" data-width="100%">
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                                @error('status')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-0">Đăng bài</button>
                    </form>
                </div>
                {{-- <div class="card-body ">
                    <h5 class="mb-4">Quill Standart</h5>
                    <div class="html-editor" name="content" form="form-add-post" id="quillEditor"></div>
                </div> --}}
            </div>
        </div>
    </main>
@endsection
