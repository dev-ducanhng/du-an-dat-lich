@extends('layouts.home')
@section('content')
    <main>
        <div class="container" style="padding: 150px 0;">
            <h5 class="mb-5">Đổi mật khẩu</h5>
            @if (Session::has('message_success_change_password'))
                <p class="login-box-msg text-success">{{ Session::get('message_success_change_password') }}</p>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data"
                        class="needs-validation tooltip-label-right" novalidate="">
                        @csrf
                        <div class="form-group position-relative error-l-50">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" name="old_password" id="old_password" class="input-sm form-control">
                            @if (Session::has('message_error_change_password'))
                                <p class="text-danger mt-2">{{ Session::get('message_error_change_password') }}</p>
                            @endif
                            @error('old_password')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group position-relative error-l-50">
                            <label>Nhập mật khẩu mới</label>
                            <input type="password" name="password" id="password" class="input-sm form-control">
                            @error('password')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group position-relative error-l-50">
                            <label>Nhập lại mật khẩu mới</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="input-sm form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mb-0">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
