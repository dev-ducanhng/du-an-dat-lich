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
            <div class="row bd">
                <div class="col-lg-6 col-12">
                    <div class="group-profile">
                        @if (strpos(\Illuminate\Support\Facades\Auth::user()->avatar, 'user-default-avatar.jpg') != false)
                            <img alt="Profile Picture"
                                 src="{{ asset(\Illuminate\Support\Facades\Auth::user()->avatar) }}"/>
                        @else
                            <img alt="Profile Picture"
                                 src="{{ asset('storage/images/users/' . \Illuminate\Support\Facades\Auth::user()->avatar) }}"/>
                        @endif
                        <div class="text">
                            <h3>
                                <i class="fas fa-thin fa-file-signature pr-2"></i>{{\Illuminate\Support\Facades\Auth::user()->name}}
                            </h3>
                            <p>
                                <i class="fas fa-thin fa-envelope pr-3"></i>{{\Illuminate\Support\Facades\Auth::user()->email}}
                            </p>
                            <p>
                                <i class="fas fa-thin fa-phone pr-3"></i>{{\Illuminate\Support\Facades\Auth::user()->phone}}
                            </p>
                        </div>

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
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="phone_number"
                                   placeholder="Nhập số điện thoại của bạn"
                                   value="{{request()->input('phone_number')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên của bạn"
                                   value="{{request()->input('name')}}">
                        </div>
                        <div class="text-center  mx-auto" style="width: 500px">
                            <button type="submit" class="btn button-search px-5 py-2">Tìm kiếm lịch sử đặt lịch</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="tab mt-5" role="tabpanel">
            <form action="" method="GET" id="filterForm" class="d-flex justify-content-between">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation">
                        <button href="#Section" type="button" class="filterList" name="filterList"
                                role="tab"
                                data-toggle="tab">Tất cả lịch đặt
                        </button>
                    </li>
                    <li role="presentation">
                        <button href="#Section" type="button" class="filterToday" name="filterToday"
                                role="tab" data-toggle="tab">
                            Hôm nay
                        </button>
                    </li>
                    <li role="presentation">
                        <button href="#Section" type="button" class="filterSolve" name="filterSolve"
                                role="tab"
                                data-toggle="tab">Chưa cắt
                        </button>
                    </li>
                    <li role="presentation">
                        <button href="#Section" type="button" class="filterCancel" name="filterCancel"
                                role="tab"
                                data-toggle="tab">Khách hủy
                        </button>
                    </li>
                </ul>
                <input type="text" class="filterValue" value="" name="filterValue" hidden>
            </form>

            <div class="h-full py-2 mb-5">
                <!-- Table -->
                <div class="w-full mx-auto bg-white  rounded-sm">
                    <header>
                        <h2 class="font-semibold text-gray-800">Danh sách đặt lịch</h2>
                    </header>
                    <div class="py-1">
                        <div class="overflow-x-auto">
                            <div class="tab-content tabs">
                                <div role="tabpanel" class="tab-pane fade in active show" id="Section">
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
                                                        @if(auth()->user() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::STYLIST_ROLE)
                                                            <a class="with-tooltip change-status p-3 text-white"
                                                               style="width: 20px; height: 20px; background: #cf6f29"
                                                               data-tooltip-content="Cập nhật trạng thái"
                                                               data-toggle="modal"
                                                               data-target='#practice_modal'
                                                               data-id="{{ $booking->id }}"
                                                               id="updateStatus">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <div class="text-center">
                                                    <td class="text-center" colspan="12">
                                                        <div class="text-center mt-5 text-danger py-5">Bạn không có lịch
                                                            đặt
                                                            nào được hiển thị.
                                                        </div>
                                                    </td>
                                                </div>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                @if($dataBookings)
                                    {{$dataBookings->links()}}
                                @endif
                            </div>
                            <div class="modal fade" id="practice_modal">
                                <div class="modal-dialog">
                                    <p class="text-center">Cập nhật trạng thái</p>
                                    <form id="statusData" action="{{route('update-status-booking')}}" method="POST">
                                        @csrf
                                        <div class="modal-content p-3" style="border: 1px solid  #F28123">
                                            <input type="hidden" id="booking_id" name="booking_id" value="">
                                            <div class="modal-body">
                                                <select name="status" id="changeStatus" class="form-control">
                                                    <option value="0">Đã hoàn thành</option>
                                                    <option value="1">Chưa hoàn thành</option>
                                                    <option value="2">Đã hủy</option>
                                                </select>
                                            </div>
                                            <div class="text-center">
                                                <button data-dismiss="modal" class="btn btn-update p-2"
                                                        style="width: 100px; border-radius: unset !important;">Hủy
                                                </button>

                                                <button type="submit"
                                                        class="btn btnSubmit btn-update  ml-2 p-2"
                                                        style="width: 200px; border-radius: unset !important;"> Cập nhật
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('javascript')
    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
    <script>
        $('body').on('click', '#updateStatus', function (event) {
            event.preventDefault();
            let id = $(this).data('id');
            $("#booking_id").val(id)
        });
        let filterButton = document.querySelector('.filterToday')
        let filterSolved = document.querySelector('.filterSolve')
        let filterList = document.querySelector('.filterList')
        let filterCancel = document.querySelector('.filterCancel')
        let filterValue = document.querySelector('.filterValue')
        let filterForm = document.querySelector('#filterForm')

        filterButton.addEventListener('click', () => {
            filterValue.value = 'today'
            filterForm.submit()
        })
        filterSolved.addEventListener('click', () => {
            filterValue.value = 'solved'
            filterForm.submit()
        })
        filterList.addEventListener('click', () => {
            filterValue.value = 'list'
            filterForm.submit()
        })
        filterCancel.addEventListener('click', () => {
            filterValue.value = 'cancel'
            filterForm.submit()
        })
    </script>
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

        .button-search, .btn-update {
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

        filterForm   button:hover, button:focus {
            text-decoration: none !important;
            outline: none !important;
        }

        .tab .nav-tabs {
            border: none;
            margin: 0;
        }

        .tab .nav-tabs li button {
            padding: 10px;
            margin-right: 20px;
            font-weight: 600;
            color: #293241;
            text-transform: uppercase;
            border: none;
            border-radius: 0;
            background: transparent;
            z-index: 2;
            position: relative;
            transition: all 0.3s ease 0s;
        }

        .tab .nav-tabs li button:hover,
        .tab .nav-tabs li.active button {
            border: none;
        }

        .tab .nav-tabs li button:before {
            content: "";
            width: 100%;
            height: 4px;
            background: #f6f6f6;
            border: 1px solid #e9e9e9;
            border-radius: 2px;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .tab .nav-tabs li button:after {
            content: "";
            width: 0;
            height: 4px;
            background: #727cb6;
            border: 1px solid #727cb6;
            border-radius: 2px;
            position: absolute;
            bottom: 0;
            left: 0;
            opacity: 0;
            z-index: 1;
            transition: all 1s ease 0s;
        }

        .tab .nav-tabs li:hover button:after,
        .tab .nav-tabs li.active button:after {
            width: 100%;
            opacity: 1;
        }

        .tab .tab-content {
            margin-top: 20px;
            font-size: 17px;
            letter-spacing: 1px;
            line-height: 30px;
            position: relative;
        }

        @media only screen and (max-width: 479px) {
            .tab .nav-tabs li {
                width: 100%;
                text-align: center;
                margin-bottom: 15px;
            }

            .tab .tab-content {
                margin-top: 0;
            }
        }

    </style>
@endpush
