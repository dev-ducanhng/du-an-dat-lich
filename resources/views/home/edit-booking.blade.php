@extends('layouts.home')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Chỉnh sửa đặt lịch</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    {{--    form booking--}}
    <div class="container">
        <form class="form-book" method="POST">
            @csrf
            <div class="text-center py-3">
                <h3>Chỉnh sửa thông tin đặt lịch</h3>
                <hr>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <input type="text" class="form-control" name="phone_number"
                           value="{{$bookingDetail->phone_number ?? request()->old('phone_number')}}"
                           @if(auth()->user()) hidden @endif
                           placeholder="Số điện thọai">
                    @error('phone_number')
                    <p class="text-danger py-2">{{$message}}</p>
                    @enderror
                    <p class="text-danger py-2 show-error-phone"></p>
                </div>
                <div class="form-group col-6">
                    <input type="text" class="form-control" name="customer_name"
                           value="{{ $bookingDetail->customer_name ?? request()->old('customer_name')}}"
                           placeholder="Nhập tên của bạn"
                           @if(auth()->user()) hidden @endif>
                    @error('customer_name')
                    <p class="text-danger py-2">{{$message}}</p>
                    @enderror
                    <p class="text-danger py-2 show-error-name"></p>

                </div>
                <div class="form-field col-12 form-group">
                    <input id="datepicker" type="text" name="booking_date"
                           value="{{request()->old('booking_date') ?? $bookingDetail->bookingDate->date}}"
                           class="form-control datepicker"
                           placeholder="Chọn ngày"/>
                    @error('booking_date')
                    <p class="text-danger py-2">{{$message}}</p>
                    @enderror
                    <p class="text-danger py-2 show-error-date"></p>

                </div>

                <div class="form-group col-12 ">
                    <div style="border: 1px solid #F28123;" class="text-center">
                        <label for="exampleFormControlSelect1" class="w-100 text-white"
                               style="background-color: #F28123; padding: 10px 0; font-size: 16px">Chọn dịch vụ</label>
                        <div class="checkboxes flex" style="padding: 10px 0">
                            @foreach($services as $key => $service)
                                <label class="checkbox">
                                    <input type="checkbox" name="service[]" value="{{$service->id}}"
                                           @if(request()->old('service')  && in_array($service->id, request()->old('service')) )
                                           checked
                                           @elseif($bookingServiceId && in_array($service->id, $bookingServiceId))
                                           checked
                                        @endif
                                    /><span
                                        class="indicator"
                                    ></span>
                                    <b>{{$service->name}}</b>
                                    - {{number_format($service->price -  $service->price *  $service->discount / 100, 0, '', ',') . 'VNĐ'}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @error('service')
                    <p class="text-danger py-2">{{$message}}</p>
                    @enderror
                    <p class="text-danger py-2 show-error-service"></p>

                </div>
                {{--  dịch vụ--}}
                <div class="form-group col-12 mt-2">
                    <div class="position-relative mb-2">
                        <div id="app-cover">
                            <div id="select-box">
                                <input type="checkbox" id="options-view-button">
                                <div id="select-button" class="brd">
                                    <div id="selected-value">
                                        <span class="span-value">Chọn stylist</span>
                                    </div>
                                    <div id="chevrons">
                                        <i class="fas fa-chevron-up"></i>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div id="options" class="option-stylist">
                                    @foreach($stylists as $stylist)
                                        <div class="option">
                                            <input class="select-stylist" type="radio" value="{{$stylist->id}}"
                                                   name="stylist"
                                                   @if(request()->old('stylist') == $stylist->id) checked
                                                   @elseif($bookingDetail->stylist == $stylist->id) checked @endif>
                                            <i class="fab fas fa-user-tie"></i>
                                            <span class="label">{{$stylist->name}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('stylist')
                    <p class="text-danger py-2">{{$message}}</p>
                    @enderror
                    <p class="text-danger py-2 show-error-stylist"></p>

                </div>
                <div class="form-group p-3">
                    <div class="select-time form-group" style="border: 1px solid #F28123">
                        <p class="text-center text-white"
                           style="background-color: #F28123; padding: 10px 0; font-size: 16px">
                            Chọn giờ
                        </p>
                        <div class="row p-2" id="timeBooking">
                        </div>
                    </div>
                    @error('booking_time')
                    <p class="text-danger py-2">{{$message}}</p>
                    @enderror
                    <p class="text-danger py-2 show-error-time"></p>

                </div>
                <div class="form-group p-3">
                    <div class="check">
                        <div class="check__item">
                            <label>
                                <input type="checkbox" class="default__check switchbox form-control is-multiple"
                                       name="multiple_booking"
                                       @if(request()->old('multiple_booking')) checked
                                       @elseif($bookingDetail->multiple_booking) checked @endif>
                                <span class="custom__check"></span>
                                Bạn đặt cho nhiều người?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 ">
                    <input type="number" min="2" max="5" class="form-control w-100 select-number"
                           value="{{request()->old('amount_number_booking') ?? $bookingDetail->amount_number_booking}}"
                           name="amount_number_booking"
                           placeholder="Nhập số lượng người bạn muốn đặt, chỉ được đặt tối đa 5 người" hidden>
                    @error('amount_number_booking')
                    <p class="text-danger py-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control" placeholder="Ghi chú" name="note"
                           value="{{request()->old('note') ?? $bookingDetail->note}}">
                </div>
                <div class="summit-button form-group col-4 mx-auto">
                    <button type="submit" data-toggle="modal" data-target="#exampleModal"
                            class="btn w-75 rounded-0 form-control" id="bookingButton">Đặt lịch
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('javascript')
    <script>
        let stylists = document.querySelectorAll('.select-stylist');
        let stylistSelected = document.querySelector('.span-value');
        let data = <?php echo json_encode($stylists); ?>;
        let selectStylist = document.querySelector('.option-stylist')
        let selectStylistButton = document.querySelector('#options-view-button')
        let datePicker = document.querySelector('.datepicker')
        let isMultiple = document.querySelector('.is-multiple')
        let numberBooking = document.querySelector('.select-number')
        let oldInput = "{{request()->old('booking_time') ?? $bookingDetail->bookingDate->bookingTime[0]->id}}"
        let inputDate = "{{request()->old('booking_date') ?? $bookingDetail->bookingDate->date}}"
        if (inputDate === '') {
            datePicker.value = new Date().toISOString().slice(0, 10);
        } else {
            datePicker.value == "{{$bookingDetail->bookingDate->date}}"
        }

        selectStylist.hidden = false
        stylists.forEach((stylist, index) => {
            if (stylist.checked === true) {
                stylistSelected.innerHTML = data[index].name
            }
            stylist.addEventListener('change', () => {
                stylistSelected.innerHTML = data[index].name
                selectStylist.hidden = true
            })
        })
        selectStylistButton.addEventListener('click', () => {
            selectStylist.hidden = false
        })
        if (isMultiple.checked == true) {
            numberBooking.hidden = false
            isMultiple.value = 1
        } else {
            numberBooking.hidden = true
        }
        isMultiple.addEventListener('change', () => {
            if (isMultiple.checked == true) {
                numberBooking.hidden = false
                isMultiple.value = 1
            } else {
                numberBooking.hidden = true
            }
        })

        let datepicker = MCDatepicker.create({
            el: '#datepicker',
            dateFormat: 'YYYY-mm-dd',
            theme: {
                theme_color: '#F28123',
                active_text_color: '#F28123',
                picker_header: {
                    active: '#FFFFFF',
                    inactive: '#F28123'
                }
            },
            bodyType: 'modal',
            selectedDate: new Date(),
            minDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
            maxDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate() + 7)
        })
        let string = ''
        let checked = ''
        let unavailable = ''
        let disable = ''
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url('bookingDate')}}/' + datePicker.value,
            success: function (data) {
                let timeRender = ''
                data.forEach(item => {
                    if (item.status == 1) {
                        string = 'class="disabled-selectime" '
                        unavailable = "- Hết chỗ"
                        disable = 'disabled'
                    } else {
                        string = ''
                        unavailable = ""
                        disable = ''
                    }
                    if (oldInput == item.id) {
                        checked = 'checked '
                    } else {
                        checked = ''
                    }
                    timeRender += `<label class="col-3">
                             <input type="radio" name="booking_time" value="${item.id}" ${checked} ${disable}/>
                                <span ${string} >${item.time} ${unavailable}</span>
                           </label>`
                })
                $('#timeBooking').html(timeRender)
            },
            error: function () {
                console.log(data);
            }
        });
        datepicker.onSelect(() => {
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '{{url('bookingDate')}}/' + datePicker.value,
                success: function (data) {
                    let timeRender = ''
                    data.forEach(item => {
                        if (item.status == 1) {
                            string = 'class="disabled-selectime" disabled'
                            unavailable = "- Hết chỗ"
                            disable = 'disabled'
                        } else {
                            string = ''
                            unavailable = ""
                            disable = ''
                        }
                        if (oldInput == item.id) {
                            checked = 'checked'
                        } else {
                            checked = ''
                        }
                        timeRender += `<label class="col-3">
                             <input type="radio" name="booking_time" value="${item.id}" ${checked} ${disable}/>
                                <span ${string}>${item.time} ${unavailable}</span></label>`
                    })
                    $('#timeBooking').html(timeRender)
                },
                error: function () {
                    console.log(data);
                }
            });
        });
    </script>
@endpush
@push('style')
    <style>
        .brd {
            border: 1px solid #e2eded;
        }

        #select-button {
            position: relative;
            height: 45px;
            padding: 12px 14px;
            background-color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        #options-view-button {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 100%;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        #selected-value {
            font-size: 16px;
            line-height: 1;
            margin-right: 26px;
        }

        .option i {
            width: 16px;
            height: 16px;
        }

        .option,
        .label {
            color: #2d3667;
            font-size: 16px;
        }

        #chevrons {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 12px;
            padding: 9px 14px;
        }

        #chevrons i {
            display: block;
            height: 50%;
            color: #d1dede;
            font-size: 12px;
            text-align: right;
        }


        #options {
            top: 42px;
            right: 0;
            left: 0;
            background-color: #fff;
            border-radius: 4px;
            margin-top: 5px;
        }

        .option {
            position: relative;
            line-height: 1;
            transition: 0.3s ease all;
            z-index: 10000;
        }

        .option i {
            position: absolute;
            left: 14px;
            padding: 0;
            display: none;
        }

        #options-view-button:checked ~ #options .option i {
            display: block;
            padding: 12px 0;
        }

        .label {
            display: none;
            padding: 0;
            margin-left: 27px;
        }

        #options-view-button:checked ~ #options .label {
            display: block;
            padding: 12px 14px;
        }

        input[type="radio"] {
            position: absolute;
            right: 0;
            left: 0;
            height: 100%;
            margin: 0;
            opacity: 0;
            cursor: pointer;
        }

        .option:hover {
            background-color: #F28123 !important;
        }

        .form-book input:focus, .form-book select:focus {
            box-shadow: none;
            outline: none;
            border: 1px solid #F28123;
        }

        .form-book input {
            box-shadow: none;
            outline: none;
            border: 1px solid #F28123;
        }

        .disabled-selectime {
            color: white;
            pointer-events: none;
            background: #e74c3c !important;
            border: 1px solid #e74c3c !important;
        }

        label.checkbox {
            margin-right: 1rem;
            padding-left: 1.75rem;
            position: relative;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        label.checkbox input[type="checkbox"] {
            position: absolute;
            opacity: 0;
        }

        label.checkbox input[type="checkbox"]:focus:checked ~ span {
            border: 2px solid #F28123;
        }

        label.checkbox input[type="checkbox"]:checked ~ span {
            color: #FFFFFF;
            background: #F28123 url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+DQo8c3ZnIHdpZHRoPSIxMiIgaGVpZ2h0PSI5IiB2aWV3Qm94PSIwIDAgMTIgOSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCiAgPHBhdGggZD0iTTQuNTc1IDguOTc3cy0uNDA0LS4wMDctLjUzNi0uMTY1TC4wNTcgNS42NGwuODI5LTEuMjI3TDQuNDcgNy4yNjggMTAuOTIxLjA4NmwuOTIzIDEuMTAzLTYuODYzIDcuNjRjLS4xMzQtLjAwMy0uNDA2LjE0OC0uNDA2LjE0OHoiIGZpbGw9IiNGRkYiIGZpbGwtcnVsZT0iZXZlbm9kZCIvPg0KPC9zdmc+) 50% 40% no-repeat;
            border: 2px solid #F28123;
        }

        label.checkbox span {
            border-radius: 3px;
            position: absolute;
            left: 0;
            width: 20px;
            height: 20px;
            border: 2px solid #F28123;
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .select-time input[type="radio"] {
            clip: rect(0 0 0 0);
            clip-path: inset(100%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .select-time input[type="radio"]:checked + span {
            box-shadow: 0 0 0 0.0625em #F28123;
            background-color: #F28123;
            z-index: 1;
            color: #FFFFFF;
        }

        .select-time label span {
            display: block;
            cursor: pointer;
            background-color: #fff;
            padding: 0.375em 0.75em;
            position: relative;
            margin-left: 10px;
            letter-spacing: 0.05em;
            text-align: center;
            transition: background-color 0.5s ease;
            border: 1px solid #F28123;
        }

        .select-time label span:hover {
            background-color: #8a6d3b;
            color: white;
        }

        .summit-button button {
            margin: 0 auto;
            background-color: #F28123;
            border: 1px solid #F28123;
            color: white;
        }

        .summit-button button:hover {
            background-color: #FFFFFF;
            color: #F28123;
        }

        .check__item label {
            display: flex;
            align-items: center;
            column-gap: 6px;
        }

        .default__check[type="checkbox"] {
            display: none;
        }

        .default__check[type="checkbox"] ~ .custom__check {
            display: flex;
            align-items: center;
            height: 24px;
            border: 2px solid #F28123;
            position: relative;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .default__check[type="checkbox"] ~ .custom__check:after {
            content: "";
            display: inline-block;
            position: absolute;
            transition: all 0.4s ease;
        }


        .default__check[type="checkbox"].switchbox + .custom__check {
            width: 50px;
        }

        .default__check[type="checkbox"].switchbox + .custom__check:after {
            transform: scale(1.5);
            left: 3px;
        }

        .default__check[type="checkbox"].switchbox:not(:checked) ~ .custom__check:after {
            background-color: #F28123;
        }

        .default__check[type="checkbox"].switchbox:checked ~ .custom__check:after {
            left: 33px;
        }

        .default__check[type="checkbox"]:disabled ~ .custom__check {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .default__check[type="checkbox"]:checked ~ .custom__check {
            background-color: #F28123;
        }

        .default__check[type="checkbox"]:checked ~ .custom__check:after {
            visibility: visible;
        }

        .default__check[type="checkbox"]:not(.switchbox) ~ .custom__check {
            border-radius: 0.375rem;
        }

        .default__check[type="checkbox"]:not(.switchbox) ~ .custom__check:after {
            height: 7px;
            width: 3px;
            margin-top: -1px;
            border-bottom: 2px solid #fff;
            border-right: 2px solid #fff;
            transform: rotate(45deg);
        }

        .default__check[type="radio"] ~ .custom__check, .default__check[type="checkbox"].switchbox ~ .custom__check {
            border-radius: 50rem;
        }

        .default__check[type="radio"] ~ .custom__check:after, .default__check[type="checkbox"].switchbox ~ .custom__check:after {
            width: 10px;
            height: 10px;
            background-color: #fff;
            border-radius: 50rem;
        }


    </style>
@endpush
