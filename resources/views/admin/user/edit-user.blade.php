@extends('layouts.dashboard')
@section('content')
    <main style="z-index: -1000">
        <div class="row">
            <div class="col-12 mb-4">
                <h5 class="mb-4">Thêm thông tin người dùng</h5>
                <div class="card mb-4">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div style="z-index: 1">
                            <div class="card-body p-3">
                                <div class="form-group position-relative error-l-100">
                                    <input class="form-control" name="email"
                                           placeholder="Nhập địa chỉ email ..." value="{{$userInfo->email}}">
                                    @error('email')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group position-relative error-l-100">
                                    <input type="text" class="form-control" name="phone"
                                           placeholder="Nhập số điện thoại..." value="{{$userInfo->phone}}">
                                    @error('phone')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group has-float-label w-100">
                                    <select class="form-control select2-single" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if($userInfo->role_id == $role->id) selected @endif>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    <span>Chức vụ</span>
                                </div>
                                <div class="form-group position-relative error-l-75">
                                    <input type="text" class="form-control" name="name" placeholder="Nhập tên ..."
                                           value="{{$userInfo->name}}">
                                    @error('name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group has-float-label w-100">
                                    <select class="form-control select2-single" name="gender">
                                        <option value="1" @if($userInfo->gender == 1) selected @endif>Nam</option>
                                        <option value="2" @if($userInfo->gender == 2) selected @endif>Nữ</option>
                                    </select>
                                    <span>Giới tính</span>
                                </div>
                                <div class="form-group position-relative error-l-75">
                                    <input id="demo-responsive-drop" class="form-control" name="date-of-birth"
                                           data-label-style="stacked" data-input-style="box"
                                           placeholder="Nhập ngày tháng năm sinh" value="{{$userInfo->dob}}"/>
                                    @error('date-of-birth')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-center py-3">
                                    <img src="{{ asset('storage/images/users/' . $userInfo->avatar)}}" class="rounded-lg" width="20%" height="20%" alt="">
                                </div>
                                <div class="dropzone"></div>
                                <input type="file" accept="jpg,jpeg,png" name="image" class="upload-image" hidden>
                                @error('image')
                                <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                                <div class="form-group has-float-label w-100 mt-3">
                                    <select class="form-control select2-single" name="status">
                                        <option value="0" @if($userInfo->status == 0) selected @endif>Hoạt động</option>
                                        <option value="1" @if($userInfo->status == 1) selected @endif>Không hoạt động</option>
                                    </select>
                                    <span>Tình trạng</span>
                                </div>
                            </div>

                            <div class="btn-toolbar custom-toolbar text-center card-body mb-5">
                                <button class="btn btn-secondary ml-2" type="submit">Hoàn thành</button>
                                <a class="btn btn-warning ml-2" type="button" href="{{route('dashboard.user.list')}}">Hủy</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('javascript')
    <script>
        mobiscroll.setOptions({
            theme: 'windows',
            themeVariant: 'light'
        });

        mobiscroll.datepicker('#demo-responsive-drop', {
            controls: ['date'],
            responsive: {
                xsmall: {
                    display: 'bottom'
                },
                small: {
                    display: 'anchored'
                },
                custom: { // Custom breakpoint
                    breakpoint: 800,
                    display: 'anchored',
                    touchUi: false
                }
            }
        });
        $(".dropzone").click(function () {
            $(".upload-image").click();
        });
    </script>
@endpush
