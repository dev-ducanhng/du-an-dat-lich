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
            </div>
        @else
            <div class="pt-5">
                <div class="title-header text-center">
                    <h6> Nếu bạn không phải là thành viên của chúng tôi. Vui lòng nhập số điện thoại để xem lịch sử của
                        bạn.</h6>
                </div>
                <div class="">
                    <form action="" class="row mt-5 form-search-booking w-50 mx-auto">
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="phone_number"
                                   placeholder="Nhập số điện thoại của bạn" value="{{request()->input('phone_number')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên của bạn" value="{{request()->input('name')}}">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" name="code" placeholder="Nhập mã code nếu đặt theo nhóm người" value="{{request()->input('code')}}">
                        </div>
                        <div class="text-center  mx-auto" style="width: 500px">
                            <button type="submit" class="btn button-search px-5 py-2">Tìm kiếm lịch sử đặt lịch</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="h-full py-2 mb-5">
            <!-- Table -->
            <div class="w-full mx-auto bg-white  rounded-sm">
                <header class="py-4">
                    <h2 class="font-semibold text-gray-800">Danh sách đặt lịch</h2>
                </header>
                <div class="py-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="font-semibold uppercase text-gray-400 bg-dark text-white">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Tên khách hàng</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Số điện thoại</div>
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
                                    <div class="font-semibold text-left">Dịch vụ</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Số người</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Giá</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Tình trạng</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">

                            @if(count($dataBookings) > 0)
                                @foreach($dataBookings as $booking)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class=" p-2  text-gray-800 text-left font-weight-bold">{{$booking->customer_name}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class=" p-2  text-gray-800 text-left font-weight-bold">{{$booking->phone_number}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class="p-2 text-left text-danger ">{{$booking->bookingDate->date}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class="p-2 text-left  text-left text-danger">{{date('G:i', strtotime($booking->booking_time))}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class="p-2 text-left  text-info text-left">{{$booking->Stylist->name}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class="p-2 text-left  text-green-500 text-left">{{$booking->present()->getListService}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class=" p-2 text-left  text-green-500 text-left">{{$booking->amount_number_booking ?? 0}}</div>
                                        </td>
                                        <td class="py-2 whitespace-nowrap">
                                            <div
                                                class="p-2 text-left  text-green-500 text-left">{{$booking->present()->getServicePrice}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div
                                                class="p-2 text-left  badge text-white
                                                @if($booking->status == \App\Models\Booking::SOLVED_YET)
                                                    badge-warning
                                                @elseif($booking->status == \App\Models\Booking::SOLVED_YET)
                                                    badge-success
                                               @else
                                                    badge-danger
                                                @endif text-left">{{$booking->present()->getStatus}}</div>
                                        </td>
                                        <td>
                                            @if(auth()->user())
                                                <a class="with-tooltip change-status p-3 text-white" style="width: 20px; height: 20px; background: #cf6f29"
                                                   data-tooltip-content="Cập nhật trạng thái">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
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
                        <div>
                            @if($dataBookings)
                                {{$dataBookings->links()}}
                            @endif
                        </div>
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
            color: white !important;
        }

        .button-search:focus {
            border: 1px solid #F28123;
            border-radius: 2px;
            outline: 0 !important;
            box-shadow: none !important;
            background: #F28123;
            color: white !important;
        }


        .change-status {
            font-weight: bold;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            background-color: inherit;
        }

        .with-tooltip {
            position: relative;
        }

        .with-tooltip::after {
            content: attr(data-tooltip-content);
            padding: 8px;
            border-radius: 4px;
            position: absolute;
            color: white;
            bottom: 115%;
            right: 50%;
            left: 50%;
            width: max-content;
            background-color: gray;
            opacity: 0;
            font-size: 0.8rem;
            visibility: hidden;
            transform: translate(-50%, 18px) scale(0.8);
            transition: visibility, opacity, transform 200ms;
        }

        .with-tooltip:hover::after {
            visibility: visible;
            opacity: 1;
            transform: translate(-50%, 0);
        }

    </style>
@endpush
