@extends('layouts.home')
@section('content')

    <main>
        <div class="container">
            <div class="page-content " id="page-content">
                <div class=" d-flex ">
                    <div class="col-xl-12 col-md-12">
                        <div class="card user-card-full">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25">
                                            @if (strpos($profile->avatar, 'user-default-avatar.jpg') != false)
                                                <img src="{{ asset($profile->avatar) }}" alt="avatar" class="img-radius"
                                                    style="width: 200px;">
                                            @else
                                                <img src="{{ asset('storage/images/users/' . $profile->avatar) }}"
                                                    alt="avatar" class="img-radius" style="width: 200px;">
                                            @endif
                                        </div>
                                        <h4 class="f-w-600 text-primary">{{ $profile->name }}</h4>
                                        <p>{{ $profile->role->name }}</p>
                                        <a href="{{ route('change-infomation') }}" class="btn btn-outline-primary">Sửa trang
                                            cá nhân</a>
                                        <a href="{{ route('change-password') }}" class="btn btn-outline-success">Đổi mật
                                            khẩu</a>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Thông tin cá nhân</h6>
                                        <div class="row">
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Tên người dùng</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->name }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Vai trò</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->role->name }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Email</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->email }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Số điện thoại</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->phone }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Giới tính</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->gender == 1 ? 'Nam' : 'Nữ' }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Ngày sinh</p>
                                                <h6 class="text-muted f-w-400">
                                                    {{ date('d/m/Y', strtotime($profile->dob)) }}</h6>
                                            </div>
                                            @if ($profile->role_id == \App\Models\User::STYLIST_ROLE && $profile->total_rating != null && $profile->count_rating != null)
                                                <div class="col-sm-6 m-b-10">
                                                    <p class="f-w-600" style="margin-bottom: 5px;">Điểm đánh giá</p>
                                                    <h6 class="text-muted f-w-400">
                                                        @if (ceil($profile->total_rating / $profile->count_rating) == 1)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 2)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 3)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 4)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 5)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                        @endif
                                                    </h6>
                                                </div>
                                            @endif
                                        </div>
                                        <ul class="social-link list-unstyled m-t-40 m-b-10">
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                    title="" data-original-title="facebook" data-abc="true"><i
                                                        class="mdi mdi-facebook feather icon-facebook facebook"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                    title="" data-original-title="twitter" data-abc="true"><i
                                                        class="mdi mdi-twitter feather icon-twitter twitter"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                    title="" data-original-title="instagram" data-abc="true"><i
                                                        class="mdi mdi-instagram feather icon-instagram instagram"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
