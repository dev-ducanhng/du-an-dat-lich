@extends('layouts.home')
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">

    <style>
        .star {
            display: inline-block;
            background: url('star-rating/star_rating.png');
            background-repeat: no-repeat;
            width: 19px;
            min-width: 19px;
            height: 18px;
            min-height: 18px;
        }

        .star_rating_on {
            background: url('star-rating/star_rating_on.png');
        }

        .padding {
            padding: 3rem !important
        }

        .sticky-wrapper {
            position: unset;
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
            background: #dcdcdc;
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
        }

        h6 {
            font-size: 14px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px) {
            p {
                font-size: 14px;
            }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>
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
