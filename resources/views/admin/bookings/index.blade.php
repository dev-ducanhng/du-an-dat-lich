@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="row card p-3">
            <div>
                <div class="tab" role="tabpanel">
                    <!-- Nav tabs -->
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
                        <div>
                            <div class="form-group has-float-label w-100">
                                <select class="form-control select2-single" onchange="changeValue()" id="searchByName"
                                        name="staff">
                                    <option value=" ">Chọn nhân viên</option>
                                    @foreach($staffs as $staff)
                                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                                    @endforeach
                                </select>
                                <span>Tìm theo nhân viên</span>
                            </div>
                        </div>
                    </form>
                    <!-- Tab panes -->
                    <div class="tab-content tabs">
                        <div role="tabpanel" class="tab-pane fade in active show" id="Section">
                            <div class="row">
                                @if($getAllBookings->count() > 0)
                                    @foreach($getAllBookings as $key => $booking)
                                        <div class="col-12 col-lg-6 mb-5 ">
                                            <form action="">
                                                <div class="card flex-row listing-card-container booking">
                                                    <div class="editAction" onclick="editBooking('{{$key}}')">
                                                        <i class="iconsminds-pen-2 large-icon initial-height"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="card-body">
                                                            <h5 class="">Nhân viên cắt
                                                                tóc: <strong>{{$booking->stylistInfo->name}}</strong>
                                                            </h5>
                                                            <hr>
                                                            <div class="d-flex flex-row align-items-center mb-1">
                                                                <a class="d-block position-relative" href="#">
                                                                    <i class="iconsminds-stopwatch large-icon initial-height"></i>
                                                                </a>
                                                                <div class="pl-3 pr-2">
                                                                    <p class="list-item-heading mb-1">
                                                                        <strong>{{date('H:i',  strtotime($booking->booking_time))}}</strong>
                                                                        <br> {{get_weekday_name($booking->bookingDate->date)}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center mb-1">
                                                                <a class="d-block position-relative" href="#">
                                                                    <i class="iconsminds-business-man large-icon initial-height"></i>
                                                                </a>
                                                                <div class="pl-3 pr-2 2">
                                                                    <p class="list-item-heading mb-1">{{$booking->customer_name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center mb-1">
                                                                <a class="d-block position-relative" href="#">
                                                                    <i class="iconsminds-dollar large-icon initial-height"></i>
                                                                </a>
                                                                <div class="pl-3 pr-2 ">
                                                                    <p class="list-item-heading mb-1">{{$booking->present()->showTotalPrice()}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center mb-1">
                                                                <a class="d-block position-relative" href="#">
                                                                    <i class="iconsminds-checkout large-icon initial-height"></i>
                                                                </a>
                                                                <div class="pl-3 pr-2 2">
                                                                    <p class="list-item-heading mb-1">{{$booking->present()->getListService()}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center mb-1">
                                                                <a class="d-block position-relative" href="#">
                                                                    <i class="iconsminds-on-off large-icon initial-height"></i>
                                                                </a>
                                                                <div class="pl-3 pr-2 2 statusBooking">
                                                                    @if($booking->status == \App\Models\Booking::SOLVED_YET)
                                                                        <p class="list-item-heading mb-1 badge-warning px-2 py-1 rounded">
                                                                            Chưa làm cho khách
                                                                        </p>
                                                                    @elseif($booking->status == \App\Models\Booking::SOLVED)
                                                                        <p class="list-item-heading mb-1  badge-success  px-2 py-1 rounded">
                                                                            Đã làm cho khách
                                                                        </p>
                                                                    @else
                                                                        <p class="list-item-heading mb-1 badge-danger px-2 py-1 rounded">
                                                                            Khách hủy
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                                <div>
                                                                    <div
                                                                        class="form-group has-float-label w-100 updateStatusBooking invisible">
                                                                        <select
                                                                            class="form-control select2-single statusBookingUpdate"
                                                                            name="statusBooking">
                                                                            <option value="0">Đã làm cho khách
                                                                            </option>
                                                                            <option value="1"> Chưa làm cho khách</option>
                                                                            <option value="2">Khách hủy</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center mb-1">
                                                                <a class="d-block position-relative" href="#">
                                                                    <i class="iconsminds-money-bag large-icon initial-height"></i>
                                                                </a>
                                                                <div class="pl-3 pr-2 2">
                                                                    <p class="list-item-heading mb-1 statusPayment">{{$booking->payment_status == \App\Models\Booking::PAYMENT_SUCCESS ? 'Đã thanh toán' : 'Chưa thanh toán'}}</p>
                                                                </div>
                                                                <div>
                                                                    <div
                                                                        class="form-group has-float-label w-100 updateStatusPayment invisible">
                                                                        <select
                                                                            class="form-control select2-single statusPaymentUpdate"
                                                                            name="statusPayment">
                                                                            <option value="1">Đã thanh toán</option>
                                                                            <option value="0"> Chưa thanh toán</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class=" buttonAction invisible ">
                                                                <div class="d-flex justify-content-center">
                                                                    <a class="updateButton"
                                                                       onclick="updateBooking('{{$key}}', '{{$booking->id}}')">
                                                                        Cập nhật
                                                                    </a>
                                                                    <a class="ml-2" id="cancelUpdate"
                                                                       onclick="cancelBooking('{{$key}}')">
                                                                        Hủy
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center w-50 mx-auto">
                                        <p class="text-center">Không có dữ liệu.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                {{$getAllBookings->links()}}
            </div>
        </div>
    </main>
@endsection
@push('style')
    <style>
        button:hover, button:focus {
            text-decoration: none;
            outline: none;
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

        .booking {
            position: relative;
        }

        .editAction {
            position: absolute;
            cursor: pointer;
            top: 10px;
            right: 10px;
            visibility: hidden;
            transition: .3s ease-in;
            background: #d9d9d9;
        }

        .booking:hover .editAction {
            visibility: visible;
        }

        .buttonAction div {
            position: absolute;
            right: 0;
        }

        .buttonAction a {
            background: rgba(234, 97, 2, 0.85);
            color: white !important;
            border: none;
            outline: none;
            padding: 5px 20px;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endpush
@push('javascript')
    <script>
        let filterButton = document.querySelector('.filterToday')
        let filterSolved = document.querySelector('.filterSolve')
        let filterList = document.querySelector('.filterList')
        let filterCancel = document.querySelector('.filterCancel')
        let filterValue = document.querySelector('.filterValue')
        let searchByName = document.querySelector('#searchByName')
        let btnAction = document.querySelectorAll('.buttonAction')
        let editAction = document.querySelector('.editAction')
        let filterForm = document.querySelector('#filterForm')
        let statusBooking = document.querySelectorAll('.statusBooking')
        let updateStatusBooking = document.querySelectorAll('.updateStatusBooking')
        let updateStatusPayment = document.querySelectorAll('.updateStatusPayment')
        let statusPayment = document.querySelectorAll('.statusPayment')
        let statusBookingUpdate = document.querySelectorAll('.statusBookingUpdate')
        let statusPaymentUpdate = document.querySelectorAll('.statusPaymentUpdate')

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

        function cancelBooking(booking) {
            btnAction.forEach((item, index) => {
                if (booking == index) {
                    item.classList.add('invisible')
                    updateStatusBooking[index].classList.add('invisible')
                    statusBooking[index].hidden = false
                    updateStatusPayment[index].classList.add('invisible')
                    statusPayment[index].hidden = false
                }
            })
        }

        function editBooking(booking) {
            btnAction.forEach((item, index) => {
                if (booking == index) {
                    item.classList.remove('invisible')
                    statusBooking[index].hidden = true
                    statusPayment[index].hidden = true
                    updateStatusBooking[index].classList.remove('invisible')
                    updateStatusPayment[index].classList.remove('invisible')
                } else {
                    statusBooking[index].hidden = false
                    statusPayment[index].hidden = false
                    updateStatusBooking[index].classList.add('invisible')
                    updateStatusPayment[index].classList.add('invisible')
                    item.classList.add('invisible')
                }
            })
        }

        function changeValue() {
            filterForm.submit()
        }

        function updateBooking(key, bookingId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('dashboard.booking.update')}}",
                type: "POST",
                async: false,
                data: {
                    id: bookingId,
                    status: statusBookingUpdate[key].value,
                    status_payment: statusPaymentUpdate[key].value
                },
                success: (response => {
                    window.location.href = "{{route('dashboard.booking.index')}}";
                })
            })
        }
    </script>
@endpush
