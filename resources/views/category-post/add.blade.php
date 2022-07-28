@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-2 mb-5"></div>
                <div class="col-8 mb-5">
                    <h5 class="mb-5">Thêm danh mục bài viết</h5>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="" method="POST" class="needs-validation tooltip-label-right" novalidate="">
                                @csrf
                                <div class="form-group position-relative error-l-50">
                                    <label>Tên danh mục bài viết</label>
                                    <input type="text" name="name" id="name" class="input-sm form-control"
                                        required="">
                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mb-0">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-2 mb-5"></div>
            </div>
        </div>
    </main>
@endsection