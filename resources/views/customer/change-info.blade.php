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
            <div class="row">
                <div class="col-2 mb-5"></div>
                <div class="col-8 mb-5">
                    <h5 class="mb-5">Cập nhật thông tin cá nhân</h5>
                    @if (Session::has('message_success'))
                        <p class="login-box-msg text-success">{{ Session::get('message_success') }}</p>
                    @endif
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data"
                                class="row needs-validation tooltip-label-right" novalidate="">
                                @csrf
                                <div class="col-4">
                                    <div class="form-group position-relative error-l-50">
                                        <label>Ảnh</label>
                                        <input type="file" accept="image/*" id="file" onchange="loadFile(event)"
                                            name="avatar" class="input-sm form-control">
                                        <img src="{{ asset('storage/images/users/' . $user->avatar) }}" id="output"
                                            class="mt-2 rounded-circle" width="100%" />
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group position-relative error-l-50">
                                        <label>Tên người dùng</label>
                                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                                            class="input-sm form-control">
                                        @error('name')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative error-l-50">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" value="{{ $user->email }}"
                                            class="input-sm form-control">
                                        @error('email')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative error-l-50">
                                        <label>Số điện thoại</label>
                                        <input type="number" name="phone" id="phone" value="{{ $user->phone }}"
                                            class="input-sm form-control">
                                        @error('phone')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative error-l-50">
                                        <label for="">Giới tính</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" value="1" name="gender"
                                                class="custom-control-input"
                                                @if ($user->gender == 1) checked @endif>
                                            <label class="custom-control-label" for="customRadio1">Nam</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" value="2" name="gender"
                                                class="custom-control-input"
                                                @if ($user->gender == 2) checked @endif>
                                            <label class="custom-control-label" for="customRadio2">Nữ</label>
                                        </div>
                                    </div>
                                    <div class="form-group position-relative error-l-50">
                                        <label>Ngày sinh</label>
                                        <input type="date" name="dob" id="dob"
                                            value="{{ date('Y-m-d', strtotime($user->dob)) }}"
                                            class="input-sm form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mb-0">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-2 mb-5"></div>
            </div>
        </div>
    </main>
@endsection
