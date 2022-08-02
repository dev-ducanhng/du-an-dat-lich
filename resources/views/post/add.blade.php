
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous"/>
<script type="text/javascript">
    var loadFile = function (event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

</script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>
<style>
    .tox-notifications-container{
        display: none !important;
    }
</style>
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
                                <img id="output" class="mt-2 rounded-circle" width="100%"/>
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
                                <textarea name="content" id="myeditorinstance" rows="5" cols="40"
                                          class="form-control tinymce-editor"></textarea>
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

