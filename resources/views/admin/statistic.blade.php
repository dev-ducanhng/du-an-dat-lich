@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="">
                                <h5>
                                    Thống kê lịch đặt theo stylist
                                </h5>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <input id="start" type="text" class="form-control py-3"
                                               name="start_date"
                                               placeholder="Từ ngày" autocomplete="off" >
                                    </div>
                                    <div class="">
                                        <input id="end" placeholder="đến ngày" type="text"
                                               class="form-control py-3" name="end_date" autocomplete="off">
                                    </div>
                                    <div class="form-group has-float-label ">
                                        <select class="form-control select2-single" name="stylist" id="selectStylist">
                                            <option value="0">Chọn stylist</option>
                                            @foreach($stylists as $stylist)
                                                <option value="{{$stylist->id}}">
                                                    {{$stylist->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span>Chọn stylist</span>
                                    </div>
                                    <div class="">
                                        <a class="btn py-2 btn-filter" id="btnFilter" style="cursor: pointer"> Lọc </a>
                                    </div>
                                </div>
                            </div>
                            <table class="data-table data-table-standard responsive nowrap"
                                   data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                <tr>
                                    <th>Tên nhân viên</th>
                                    <th>Số lịch đặt</th>
                                </tr>
                                </thead>
                                <tbody id="dataTableList">
                                @foreach($dataStylist as $stylist)
                                    <tr>
                                        <td>
                                            <p class="list-item-heading">{{$stylist->name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-muted">{{count($stylist->bookings)}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="card ">
                        <div class="card-body">
                            <div class="">
                                <h5>
                                    Thống kê doanh thu theo kỳ
                                </h5>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <input id="startCount" type="text" class="form-control py-3"
                                               name="start_date"
                                               placeholder="Từ ngày" autocomplete="off">
                                    </div>
                                    <div class="">
                                        <input id="endCount" placeholder="đến ngày" type="text"
                                               class="form-control py-3" name="end_date" autocomplete="off">
                                    </div>
                                    <div class="has-float-label ">
                                        <select class="form-control select2-single" name="stylist" id="selectMonth">
                                            <option value="0" selected>Chọn tháng</option>
                                            <option value="1">Tháng 1</option>
                                            <option value="2">Tháng 2</option>
                                            <option value="3">Tháng 3</option>
                                            <option value="4">Tháng 4</option>
                                            <option value="5">Tháng 5</option>
                                            <option value="6">Tháng 6</option>
                                            <option value="7">Tháng 7</option>
                                            <option value="8">Tháng 8</option>
                                            <option value="9">Tháng 9</option>
                                            <option value="10">Tháng 10</option>
                                            <option value="11">Tháng 11</option>
                                            <option value="12">Tháng 12</option>
                                        </select>
                                        <span>Chọn tháng</span>
                                    </div>
                                    <div class="">
                                        <a class="btn py-2 btn-filter" id="staticTurnover" style="cursor: pointer">
                                            Lọc </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="icon-cards-row">
                                <div class="glide dashboard-numbers">
                                    <div class="glide__track" data-glide-el="track">
                                        <ul class="glide__slides">
                                            <li class="glide__slide">
                                                <a href="#" class="card">
                                                    <div class="card-body text-center">
                                                        <i class="iconsminds-clock"></i>
                                                        <p class="card-text mb-0">Tổng số lịch đặt</p>
                                                        <p class="lead text-center"
                                                           id="totalBooking">{{$totalPrice['totalBooking']}}</p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="glide__slide">
                                                <a href="#" class="card">
                                                    <div class="card-body text-center">
                                                        <i class="iconsminds-basket-coins"></i>
                                                        <p class="card-text mb-0">Tổng tổng số lịch đặt bị hủy</p>
                                                        <p class="lead text-center"
                                                           id="bookingCancel">{{$totalPrice['bookingCancel']}}</p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="glide__slide">
                                                <a href="#" class="card">
                                                    <div class="card-body text-center">
                                                        <i class="iconsminds-arrow-refresh"></i>
                                                        <p class="card-text mb-0">Tổng doanh thu</p>
                                                        <p class="lead text-center"
                                                           id="totalPrice">{{$totalPrice['totalPrice']}}</p>
                                                    </div>
                                                </a>
                                            </li>
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
@push('javascript')
    <script>
        MCDatepicker.create({
            el: '#start',
            dateFormat: 'YYYY-mm-dd',
            theme: {
                theme_color: '#F28123',
                active_text_color: '#F28123',
                picker_header: {
                    inactive: '#F28123'
                }
            },
            bodyType: 'modal',
            selectedDate: new Date(),
            customMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            customWeekDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        })
        MCDatepicker.create({
            el: '#end',
            dateFormat: 'YYYY-mm-dd',
            theme: {
                theme_color: '#F28123',
                active_text_color: '#F28123',
                picker_header: {
                    inactive: '#F28123'
                }
            },
            bodyType: 'modal',
            selectedDate: new Date(),
            customMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            customWeekDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        })
        MCDatepicker.create({
            el: '#startCount',
            dateFormat: 'YYYY-mm-dd',
            theme: {
                theme_color: '#F28123',
                active_text_color: '#F28123',
                picker_header: {
                    inactive: '#F28123'
                }
            },
            bodyType: 'modal',
            selectedDate: new Date(),
            customMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            customWeekDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        })
        MCDatepicker.create({
            el: '#endCount',
            dateFormat: 'YYYY-mm-dd',
            theme: {
                theme_color: '#F28123',
                active_text_color: '#F28123',
                picker_header: {
                    inactive: '#F28123'
                }
            },
            bodyType: 'modal',
            selectedDate: new Date(),
            customMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            customWeekDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        })
        $('#btnFilter').click(() => {
            $.ajax({
                url: "{{route('dashboard.statistic.staticByStylist')}}",
                method: 'POST',
                data: {
                    startDate: $('#start').val(),
                    endDate: $('#end').val(),
                    stylistId: $("#selectStylist").val(),
                    '_token': '{{csrf_token()}}'
                },
                success: (response) => {
                    let statisticRender = ''
                    response.forEach(stylist => {
                        statisticRender += `
                                    <tr>
                                        <td>
                                            <p class="list-item-heading">${stylist.name}</p>
                                        </td>
                                        <td>
                                            <p class="text-muted">${stylist.numberBooking}</p>
                                        </td>
                                    </tr>
                                    `
                    })
                    $('#dataTableList').html(statisticRender)

                }
            })
        })
        $('#staticTurnover').click(() => {
            $.ajax({
                url: "{{route('dashboard.statistic.staticTurnover')}}",
                method: 'POST',
                data: {
                    startDateCount: $('#startCount').val(),
                    endDateCount: $('#endCount').val(),
                    month: $("#selectMonth").val(),
                    '_token': '{{csrf_token()}}'
                },
                success: (response) => {
                    $('#totalPrice').html(response.totalPrice)
                    $('#bookingCancel').html(response.bookingCancel)
                    $('#totalBooking').html(response.totalBooking)
                }
            })
        })
    </script>
@endpush
@push('style')
    <style>
        #btnFilter, #staticTurnover {
            background: #F28123;
            color: white;
            text-decoration: none;
            border-radius: unset !important;
        }
    </style>
@endpush
