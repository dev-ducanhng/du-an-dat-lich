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
    <!-- end breadcrumb section -->

    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <form action="" method="POST" id="bookingFormConfirm">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-accordion-wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                Thông tin dịch vụ
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordionExample">
                                        <div class="card-body mx-auto" style="width: 95%">
                                            <div class="row bill">
                                                <div
                                                    class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                    Tên người đặt lịch
                                                </div>
                                                <div class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                    {{$bookingDetail->customer_name}}
                                                </div>
                                            </div>
                                            <div class="row bill mt-1">
                                                <div
                                                    class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                    Số điện thoại
                                                </div>
                                                <div class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                    {{$bookingDetail->phone_number}}
                                                </div>
                                            </div>
                                            <div class="row bill mt-1">
                                                <div
                                                    class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                    Ngày
                                                </div>
                                                <div class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                    {{$dateBooking}}
                                                </div>
                                            </div>
                                            <div class="row bill mt-1">
                                                <div
                                                    class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                    Giờ
                                                </div>
                                                <div class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                    {{date('G:i', strtotime($bookingDetail->booking_time))}}
                                                </div>
                                            </div>
                                            <div class="row bill mt-1">
                                                <div
                                                    class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                    Stylish
                                                </div>
                                                <div class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                    {{$stylish->name}}
                                                </div>
                                            </div>
                                            @if($bookingDetail->multiple_booking == \App\Models\Booking::MULTIPLE)
                                                <div class="row bill mt-1">
                                                    <div
                                                        class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                        Mã nhóm
                                                    </div>
                                                    <div
                                                        class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                        {{$bookingDetail->booking_code}}
                                                    </div>
                                                </div>
                                                <div class="text-center py-1">
                                                    <span>(Bạn chia sẻ mã này cho bạn bè của bạn để có thể sử dụng dịch vụ của chúng tôi)</span>
                                                </div>
                                                <div class="row bill mt-1">
                                                    <div
                                                        class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                        Số lượng
                                                    </div>
                                                    <div
                                                        class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                        {{$bookingDetail->amount_number_booking}} người
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row bill mt-1">
                                                <div
                                                    class="col-md-3 bill-info bill-info-left p-2 text-center text-white font-weight-bold">
                                                    Ghi chú
                                                </div>
                                                <div class="col-md-6 bill-info bill-info-right p-2 font-weight-bold">
                                                    {{$bookingDetail->note}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                    data-target="#collapseThree" aria-expanded="false"
                                                    aria-controls="collapseThree">
                                                Hình thức thanh toán
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                         data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="card-details">
                                                <div class="radio-list">
                                                    <label class="radio">
                                                        <input class="radio-input" type="radio" checked="checked"
                                                               name="payment_method"
                                                               value="{{\App\Models\Booking::PAYMENT_WITH_CASH}}">
                                                        <span class="radio-checkmark-box">
                                                            <span class="radio-checkmark"></span>
                                                        </span>
                                                        <span class="ml-3">Thanh toán khi đến cửa hàng</span>
                                                    </label>
                                                    <label class="radio">
                                                        <input class="radio-input" type="radio" name="payment_method"
                                                               value="{{\App\Models\Booking::PAYMENT_WITH_CARD}}">
                                                        <span class="radio-checkmark-box">
                                                            <span class="radio-checkmark"></span>
                                                        </span>
                                                        <span class="ml-3">Thanh toán trực tuyến</span>
                                                    </label>
                                                    <p>Bạn nên lưu ý về quy định về các trường hợp thanh toán nhưng
                                                        không đến cửa hàng để
                                                        làm dịch vụ:</p>
                                                    <ul>
                                                        <li> Hủy dịch vụ trước 4 - 6 ngày: Hoàn trả 80% chi phí dich vụ
                                                            đã đóng
                                                        </li>
                                                        <li> Hủy dịch vụ trước 2 - 3 ngày: Hoàn trả 60% chi phí dich vụ
                                                            đã đóng
                                                        </li>
                                                        <li> Hủy dịch vụ trước 1 ngày: Hoàn trả 40% chi phí dich vụ đã
                                                            đóng
                                                        </li>
                                                        <li> Hủy dịch vụ trong ngày đặt: Không được hoàn trả phí
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mt-5">
                            <a href="{{route('edit.booking', $bookingDetail->id)}}" class="btn btn-cancel">Chỉnh sửa
                                thông tin đặt lịch</a>
                        </div>
                    </div>

                    <div class="col-lg-4 w-100">
                        <div class="order-details-wrap w-100">
                            <table class="order-details w-100">
                                <thead>
                                <tr>
                                    <th colspan="2" style="background: #F28123"
                                        class="text-center font-weight-bold text-white">Chi tiết dịch vụ
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="order-details-body">
                                <tr class="text-center text-white" style="background: #F28123 ">
                                    <td>Dịch vụ</td>
                                    <td>Giá</td>
                                </tr>
                                @foreach($bookingDetail->bookingService as $detail)
                                    <tr>
                                        <td>{{$detail->service->name}}</td>
                                        <td>{{$detail->present()->showPriceWithDiscount()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfood>
                                    <tr>
                                        <td>Tổng</td>
                                        <td class="showPrice">{{$bookingDetail->present()->showTotalPrice()}}</td>
                                    </tr>
                                </tfood>
                            </table>
                            <div class="position-relative">
                                <input type="text" placeholder="Mã giảm giá" name="discount"
                                       value="{{request()->old('discount')}}" id="discountCode"
                                       class="form-control mt-3 outline-0 border-1 shadow-0">
                                <span id="checkDiscountCode" class="position-absolute px-3 py-2"
                                      style="top: 4px; right: 3px; background: rgba(234,97,2,0.85); border-radius: 10px; color: white;cursor: pointer"> Kiểm tra </span>
                            </div>
                            <p id="showTextDiscount" class=" py-3"></p>
                            <!-- Button trigger modal -->
                            <button type="button" id="confirmBooking" class="btn btn-order py-2 font-weight-bold mt-4"
                                    data-toggle="modal" data-target="#verifyBox">
                                Xác nhận đặt lịch
                            </button>
                            <input name="redirect" hidden>
                            <!-- Modal -->
                            <div class="modal fade" id="verifyBox" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận số điện thoại là
                                                của bạn</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">Mã xác nhận đã được gửi đến số điện thoại của bạn. Vui lòng nhập mã tại đây.</p>
                                            <input type="text" placeholder="Mã xác nhận" name="phoneVerify"
                                                   class="form-control mt-3 outline-0 border-1 shadow-0 phoneVerify"
                                                   id="inputPhoneVerify">
                                            <div class="phoneVerifyError"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="text" id="verifyNumberCode" name="verifyNumberCode" hidden>
                                            <a class="btn btn-order" id="confirmInput">Xác nhận</a>
                                            <a class="btn btn-cancel" data-dismiss="modal">Hủy</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-cancel py-2 font-weight-bold mt-3" data-toggle="modal"
                                    data-target="#exampleModalCenter">Hủy
                            </button>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content text-center p-5">
                                        <p class="font-weight-bold">
                                            Bạn có chắc chắn muốn hủy đặt lịch không?
                                        </p>
                                        <div class="d-flex row align-items-center justify-content-between mt-5">
                                            <button type="button" class="btn  btn-cancel col-5" data-dismiss="modal">
                                                Huỷ
                                            </button>
                                            <a href="{{route('cancel', $bookingDetail->id)}}"
                                               class="btn btn-order col-5">Xác nhận</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        let price = $(".showPrice").html().replaceAll(',', '').slice(0, -3)
        let phoneNumber = '{{$bookingDetail->phone_number}}'
        let verifyNumberCode = document.querySelector('#verifyNumberCode')
        let phoneVerifyError = document.querySelector('.phoneVerifyError')
        let bookingFormConfirm = document.querySelector('#bookingFormConfirm')
        $('#confirmBooking').click(() => {
            $.ajax({
                url: "{{route('verifyPhone')}}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    phoneNumber: phoneNumber
                },
                success: (response => {
                    let numberCode = response.numberCode
                    verifyNumberCode.value = numberCode
                })
            })
        })
        $('#confirmInput').click(() => {
            let codeInput = $('#inputPhoneVerify').val()
            if (codeInput == '') {
                phoneVerifyError.innerHTML = `<div class="alert alert-danger mt-2" role="alert">Vui lòng nhập mã xác thực</div>`
            } else if (codeInput != verifyNumberCode.value || codeInput != '111111') {
                phoneVerifyError.innerHTML = `<div class="alert alert-danger mt-2" role="alert">Mã xác thực không chính xác. Vui lòng nhập lại.</div>`
            } else {
                bookingFormConfirm.submit()
            }
        })
        $('#checkDiscountCode').click(() => {
            $.ajax({
                url: "{{route('checkDiscount')}}",
                type: "POST",
                async: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    discount: $("#discountCode").val()
                },
                success: (response => {
                    if (response.exist) {
                        $("#showTextDiscount").html('Bạn có thể áp dụng mã giảm giá này.')
                        $("#showTextDiscount").addClass('text-success')
                        $("#showTextDiscount").removeClass('text-danger')
                        let priceWithDiscount = price - price * response.percent / 100
                        let formatCurency = priceWithDiscount.toLocaleString('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        });
                        $(".showPrice").html(formatCurency)
                    } else {
                        $("#showTextDiscount").html('Mã giảm giá không hợp lệ hoặc đã quá hạn sử dụng.')
                        $("#showTextDiscount").addClass('text-danger')
                        $("#showTextDiscount").removeClass('text-success')

                    }
                })
            })
        })
    </script>
@endpush
@push('style')
    <style>
        .bill-info-left {
            background: #F28123;
        }

        .bill {
            border: 1px solid #F28123;
        }

        .btn-order {
            background: #F28123;
            width: 100%;
            color: white;
        }

        .btn-order:hover {
            border: 1px solid #F28123;
            background: #FFFFFF;
            color: #F28123;
        }

        .btn-cancel {
            border: 1px solid #F28123;
            color: #F28123;
            width: 100%;
        }

        .btn-cancel:hover {
            background: #F28123;
            color: #FFFFFF;

        }

        .radio {
            display: flex;
            align-items: center;
            position: relative;
            cursor: pointer;
            user-select: none;
        }

        .radio:hover .checkbox-checkmark {
            border: 2px solid #F28123;
        }

        .radio-input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .radio-input:focus ~ .radio-checkmark-box {
            border-color: #F28123;
        }

        .radio-input:checked ~ .radio-checkmark-box .radio-checkmark:after {
            display: block;
        }

        .radio-input:checked ~ .radio-checkmark-box .radio-checkmark {
            background-color: #F28123;
            border: 1px solid #F28123;
        }

        .radio-input:disabled ~ .radio-checkmark-box .radio-checkmark {
            border: 1px solid #B0B0B0;
            cursor: not-allowed;
        }

        .radio-input:disabled:checked ~ .radio-checkmark-box .radio-checkmark {
            background-color: #B0B0B0;
        }

        .radio-input:disabled:checked ~ .radio-checkmark-box .radio-checkmark:after {
            background: url("data:image/svg+xml,%3Csvg width='10' height='10' viewBox='0 0 14 10' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4.8866 9.91722L0.0873348 5.36761C0.0596566 5.34137 0.037692 5.31018 0.0227039 5.27582C0.00771585 5.24146 0 5.20461 0 5.1674C0 5.13019 0.00771585 5.09335 0.0227039 5.05899C0.037692 5.02463 0.0596566 4.99343 0.0873348 4.96719L1.29893 3.81086C1.41471 3.70049 1.60183 3.70049 1.71761 3.81086L4.87718 6.80501C4.99296 6.91538 5.18143 6.91409 5.2972 6.80372L12.2787 0.0839022C12.3945 -0.0277526 12.5829 -0.0277526 12.7001 0.0826188L13.913 1.23895C14.0288 1.34932 14.0288 1.52771 13.9143 1.63809L6.30821 8.95468L6.30956 8.95597L5.30662 9.91722C5.19085 10.0276 5.00238 10.0276 4.8866 9.91722Z' fill='%2374767B'/%3E%3C/svg%3E%0A") no-repeat center;
            background-size: contain;
        }

        .radio-checkmark-box {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            border-radius: 3px;
        }

        .radio-checkmark {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #F28123;
            cursor: pointer;
            border-radius: 3px;
        }

        .radio-checkmark:after {
            content: "";
            display: none;
            background: url("data:image/svg+xml,%3Csvg width='10' height='10' viewBox='0 0 14 10' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4.8866 9.91722L0.0873348 5.36761C0.0596566 5.34137 0.037692 5.31018 0.0227039 5.27582C0.00771585 5.24146 0 5.20461 0 5.1674C0 5.13019 0.00771585 5.09335 0.0227039 5.05899C0.037692 5.02463 0.0596566 4.99343 0.0873348 4.96719L1.29893 3.81086C1.41471 3.70049 1.60183 3.70049 1.71761 3.81086L4.87718 6.80501C4.99296 6.91538 5.18143 6.91409 5.2972 6.80372L12.2787 0.0839022C12.3945 -0.0277526 12.5829 -0.0277526 12.7001 0.0826188L13.913 1.23895C14.0288 1.34932 14.0288 1.52771 13.9143 1.63809L6.30821 8.95468L6.30956 8.95597L5.30662 9.91722C5.19085 10.0276 5.00238 10.0276 4.8866 9.91722Z' fill='white'/%3E%3C/svg%3E%0A") no-repeat center;
            width: 13px;
            height: 13px;
            background-size: contain;
            border-radius: 3px;
        }

    </style>
@endpush
