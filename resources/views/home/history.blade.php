@extends('layouts.home')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Lịch sử đặt lịch</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <div class="container">
        @if(auth()->user())
            <div class="row">
                <div class="col-6">
                    <div class="group-profile">
                        <img
                            src="https://media.gettyimages.com/photos/actor-katie-holmes-poses-for-a-photo-with-lobby-signage-during-img-picture-id917483058?s=612x612"
                            alt="">
                        <div class="text">
                            <h3>{{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
                            <p>{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="gr-button">
                        <button type="button" class="btn btn-primary btn-lg stt"><i class="fas fa-solid fa-pen"></i></i>
                            Sửa
                            thông tin
                        </button>
                        <a type="button" class="btn btn-primary btn-lg lout"><i
                                class="fas fa-regular fa-power-off" href="{{route('logout')}}"></i>Logout
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="gr-his">
                        <i class="fas fa-regular fa-calendar "></i>
                        <p>Lịch sử đặt lịch</p>
                    </div>
                </div>
            </div>
        @else
            <div class="py-5">
                <div class="title-header text-center">
                    <h6> Nếu bạn không phải là thành viên của chúng tôi. Vui lòng nhập số điện thoại để xem lịch sử của
                        bạn.</h6>
                </div>
                <div class="">
                    <form action="" class="row mt-5 form-search-booking w-50 mx-auto">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại của bạn">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Nhập tên của bạn">
                        </div>
                        <div class="text-center  mx-auto" style="width: 500px">
                            <a class="btn button-search px-5 py-2">Tìm kiếm lịch sử đặt lịch</a>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="h-full py-5">
            <!-- Table -->
            <div class="w-full mx-auto bg-white  rounded-sm">
                <header class="py-4">
                    <h2 class="font-semibold text-gray-800">Danh sách đặt lịch</h2>
                </header>
                <div class="py-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Tên khách hàng</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Ngày đặt</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Giờ đặt</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Tên stylist</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Dịch vụ</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Số người</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Tình trạng</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">Action</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">

                            @if($bookings)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-medium text-gray-800">Olga Semklo</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">olga.s@cool.design</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">$1,220.66</div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <div class="text-center">
                                        <td colspan="8" class="text-center mt-5 text-danger py-5">Bạn không có lịch đặt
                                            nào được hiển thị.
                                        </td>
                                    </div>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('javascript')
    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
@endpush
@push('style')
    <style>
        .form-search-booking input {
            border: 1px solid #F28123;
            border-radius: 2px;
        }

        .form-search-booking input:focus {
            border: 1px solid #F28123;
            border-radius: 2px;
            outline: 0 !important;
            box-shadow: none !important;
        }

        .button-search {
            border: 1px solid #F28123;
            border-radius: 2px;
            outline: 0 !important;
            box-shadow: none !important;
            background: #F28123;
            color: white;
        }
        .button-search:focus{
            border: 1px solid #F28123;
            border-radius: 2px;
            outline: 0 !important;
            box-shadow: none !important;
            background: #F28123;
            color: white;
        }
    </style>
@endpush
