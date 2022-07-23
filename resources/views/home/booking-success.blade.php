@extends('layouts.home')
@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Thông tin hóa đơn</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- check out section -->
    <div class="booking-success checkout-section mt-150">
        <div class="mx-auto row">
            <div class="card mx-auto text-center col-md-6">
                <div
                    style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; border: 1px solid #F28123"
                    class="mx-auto text-center">
                    <i class="checkmark">✓</i>
                </div>
                <h1>Bạn đã đặt lịch thành công</h1>
                <p>Chúc bạn có những phút giây vui vẻ khi trải nghiệm dịch vụ của chúng tôi.</p>
            </div>
        </div>
    </div>
    <div class="booking-success checkout-section mt-80 mb-150 ">
        <div class="mx-auto row">
            <a href="{{route('index')}}" class="btn-back btn text-white mx-auto">Quay lại trang chủ</a>
        </div>
    </div>

@endsection
@push('style')
    <style>
        .booking-success h1 {
            color: #F28123;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }

        .booking-success p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        .booking-success i {
            color: #F28123;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }

        .booking-success .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
        }

        .btn-back {
            background:  #F28123;
            outline: none;
            border: none;
            padding: 20px 50px;
        }
        .btn-back:hover {
            background:  #F28123;
            outline: none;
            border: none;
            padding: 20px 50px;
        }
    </style>
@endpush
