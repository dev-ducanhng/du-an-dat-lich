@extends('layouts.dashboard')
@section('content')
    <main>
        <section class="schedule">
            <div class="container">
                <div class="row position-relative">
                    <div class="col-md-12">
                        <div class="row">
                            <div id='calendar' class="w-100"></div>
                        </div>
                        <!---row--->
                    </div>
                    <div
                        class="card shadow isHidden animated slideInRight col-xs-4 col-sm-4 borders-0 position-absolute showEvent"
                        id="event-details">
                        <div class="event-color" id="event-color"></div>
                        <div class="card-body" style="overflow-y: auto;">
                            <h3 class="card-title" id="event-title"></h3>
                            <h6 class="card-subtitle text-muted mb-3" id="eventDate"></h6>
                            <p class="card-text" id="event-info"></p>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center">
                                    Tên khách hàng: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_customer_name"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Số điện thọai: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_phone_number"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Thời gian: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_booking_time"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Giờ: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_booking_hour"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Dịch vụ: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_service"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Số người: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_number"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center">
                                    Giá: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_price"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Thanh toán: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_payment"></p>
                                </div>
                            </div>
                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Ghi chú: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_note"></p>
                                </div>
                            </div>

                            <div class="d-flex bill mt-1">
                                <div
                                    class="bill-info bill-info-left text-center ">
                                    Trạng thái: &nbsp
                                </div>
                                <div class="bill-info bill-info-right font-weight-bold">
                                    <p class="card-text" id="show_status"></p>
                                </div>
                            </div>
                            <form action="" id="statusSelect" class="w-90 mx-auto mt-3">
                                @csrf
                                <select name="status" class="form-control" id="statusValue">
                                    <option value="0">Đã làm cho khách</option>
                                    <option value="1">Chưa làm cho khách</option>
                                    <option value="2">Khách hủy</option>
                                </select>
                                <a class="btn btn-confirm-update text-white">Xác nhận</a>
                                <a class="btn btn-cancel-update">Hủy</a>
                            </form>
                            <div id="updateStatus" class="w-90 mx-auto mt-3">
                            </div>
                        </div>
                        <div class="close-card-button">
                            <i class="iconsminds-close"></i>
                        </div>

                    </div>
                </div>
            </div>
        </section>


    </main>
@endsection
@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/core/locales-all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/vi.min.js"></script>
    <script>
        $(function () {
            var $calendar = $("#calendar");
            let eventsObj = []
            $.ajax({
                url: "{{route('dashboard.booking.getAllBooking')}}",
                type: "GET",
                async: false,
                success: function (response) {

                    response.forEach((booking) => {
                        var randomColor = Math.floor(Math.random() * 16777215).toString(16);

                        let bookingTime = booking.booking_date + ' ' + booking.booking_time
                        let startTime = moment(bookingTime).format()
                        let endTime = moment(bookingTime).add('1', 'hour').format()

                        eventsObj.push({
                            title: booking.stylist,
                            start: startTime,
                            end: endTime,
                            color: '#' + randomColor,
                            phone_number: booking.phone_number,
                            payment: booking.payment,
                            note: booking.note,
                            service: booking.detail.service,
                            price: booking.detail.price,
                            customer: booking.name,
                            status: booking.status,
                            number: booking.number,
                            id: booking.id
                        })
                    })
                }
            });
            $calendar.fullCalendar({
                header: {
                    left: "view, prev,next title ",
                    right: "listDay,listWeek,listMonth"
                },
                defaultView: 'month',
                buttonIcons: {
                    prev: " iconsminds-left",
                    next: " iconsminds-right",
                },
                customButtons: {
                    view: {
                        text: "Chế độ xem"
                    }
                },
                locale: 'vi',
                fixedWeekCount: false,
                scrollTime: "10:00:00",
                nowIndicator: true,
                editable: true,
                slotLabelInterval: "01:00",
                slotLabelFormat: "h A",
                listDayFormat: "ddd MMM D",
                listDayAltFormat: false,
                views: {
                    month: {
                        timeFormat: "h(:mm) a"
                    },
                    week: {
                        titleFormat: "MMMM YYYY",
                        columnHeaderFormat: "ddd D"
                    },
                    day: {
                        titleFormat: "MMMM",
                        columnHeaderFormat: "dddd MMMM D, YYYY"
                    },
                    listMonth: {
                        titleFormat: "MMMM",
                        timeFormat: "h:mm A"
                    },
                    listDay: { buttonText: 'list day' },
                    listWeek: { buttonText: 'list week' },
                    listMonth: { buttonText: 'list month' }
                },
                events: eventsObj,
                dayClick: function (date, jsEvent, view) {
                    if (view.name !== "month") {
                        return;
                    }
                    if (view.name === "month") {
                        $calendar.fullCalendar("changeView", "agendaDay");
                        $calendar.fullCalendar("gotoDate", date);
                    }
                },
                eventClick: function (event, element) {
                    console.log(event['status']);
                    element.preventDefault();
                    var edate = moment(event.start).format("MM-DD-YYYY");
                    var $edetails = $("#event-details");
                    var etitle = event.title;
                    var $etitle = $("#event-title");
                    $etitle.html(etitle);
                    $("#eventDate").html('<span><i class="text-black iconsminds-timer"></i></span>' + " " + edate);

                    $("#event-color").css("background", event.color);
                    $("#show_phone_number").html(event.phone_number);
                    $("#show_booking_time").html(edate);
                    $("#show_service").html(event.service);
                    $("#show_note").html(event.note);
                    $("#show_price").html(event.price);
                    $("#show_customer_name").html(event.customer);
                    $("#show_booking_hour").html(moment(event.start).format("LT"));
                    $("#show_payment").html(event.payment);
                    $("#show_status").html(event.status);
                    $("#show_number").html(event.number);
                    if (event['status'] == 'Đã làm cho khách') {
                        $("#updateStatus").html('');
                    } else {
                        $("#updateStatus").html('<a class="btn btn-update">Cập nhật trạng thái</a>');
                    }
                    $('#statusSelect').hide();
                    $(".btn-update").click(() => {
                        $('#statusSelect').show()
                        $("#updateStatus").hide()
                    })
                    $(".btn-cancel-update").click(() => {
                        $("#updateStatus").show()
                        $('#statusSelect').hide()

                    })

                    $(".btn-confirm-update").click(() => {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{route('dashboard.booking.updateBooking')}}",
                            type: "POST",
                            async: false,
                            data: {
                                id: event.id,
                                status: $("#statusValue").val()
                            },
                            success: (response => {
                                window.location.href = "{{route('dashboard.booking.list')}}";
                            })
                        })
                    })
                    if ($edetails.hasClass("isHidden")) {
                        $edetails.removeClass("isHidden");
                    } else {
                        $edetails.addClass("isHidden");
                    }
                    return false;
                }
            });
        });

        $(function () {
            $(".fc-toolbar .fc-right").append($('<div class="fc-button-group btn-group dropdown"></div>'));
            $(".fc-view-button").wrap(".dropdown").addClass("dropdown-toggle btn-drop").attr("data-toggle", "dropdown");
            $(".dropdown")
                .append($('<div class="dropdown-menu">'
                    + '<button type="button" class="dropdown-item fc-agendaDay-button fc-button fc-state-default" id="daybtn">Xem theo ngày</button>'
                    + '<button type="button" class="dropdown-item fc-agendaWeek-button fc-button fc-state-default" id="weekbtn">Xêm theo tuần</button>'
                    + '<button type="button" class="dropdown-item fc-button fc-button-month fc-state-default" id="monthbtn">Xem theo tháng</button></div>'));
        });
        $(function (event, view, jsEvent) {
            var calendar = $("#calendar");
            var $this = $(this);
            var $btndrop = $this.find(".btn-drop");

            $("#daybtn").click(function (event, view) {
                event.preventDefault();
                calendar.fullCalendar("changeView", "agendaDay");
                $btndrop.html($(this).html());
            });
            $("#weekbtn").click(function (event) {
                event.preventDefault();
                calendar.fullCalendar("changeView", "agendaWeek");
                $btndrop.html($(this).html());
            });
            $("#monthbtn").click(function (event) {
                event.preventDefault();
                calendar.fullCalendar("changeView", "month");
                $btndrop.html($(this).html());
            });
        });
    </script>
    <script>
        $(".close-card-button").click(() => {
            $(".showEvent").addClass("isHidden")
        })
        $('button.fc-listDay-button').html('Xem danh sách theo ngày')
        $(document).ready(function(){
            $('.fc-listDay-button').html('Xem danh sách theo ngày')
            $('.fc-listWeek-button').html('Xem danh sách tuần')
            $('.fc-listMonth-button').html('Xem danh sách theo tháng')
        });
    </script>
@endpush
@push('style')
    <style>
        .fc-listDay-button, .fc-listWeek-button, .fc-listMonth-button {
            background: #0a2a45 !important;
            text-shadow: none;
            color: white;
            margin-left: 5px !important;
        }
        .fc-list-table .fc-widget-header{
            background: #0a2a45 !important;
            color: white;
        }
        section i {
            color: #333333 !important;
        }

        section i:hover {
            color: #8f8072 !important;
        }

        #calendar {
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
        }

        #calendar .dropdown-menu {
            font-size: 1rem;
            right: 0;
            border: none;
            margin-top: 10px;
            border-radius: 5px;
        }

        #calendar .dropdown-menu .dropdown-item {
            border: none;
            box-shadow: none;
            background: unset !important;
        }

        #calendar .dropdown-menu .dropdown-item:hover {
            background: #0a2a45 !important;
            color: white;
        }

        #calendar .dropdown .btn-drop {
            background: #0a2a45;
            color: #FFFFFF;
            text-shadow: none;
        }

        #calendar .fc-header-toolbar .fc-prev-button,
        #calendar .fc-header-toolbar .fc-next-button {
            background: #FFFFFF !important;
            color: #0a2a45;
            text-shadow: none;
            border: 1px solid #0a2a45;
            border-radius: unset;
        }

        #calendar .fc-header-toolbar .fc-prev-button:hover,
        #calendar .fc-header-toolbar .fc-prev-button .iconsminds-left:hover,
        #calendar .fc-header-toolbar .fc-next-button:hover,
        #calendar .fc-header-toolbar .fc-next-button .iconsminds-left:hover {
            background: #0a2a45 !important;
            color: white;
            text-shadow: none;
        }

        .fc-view-container {
            border: 1px solid #0a2a45 !important;
        }

        #event-details.card {
            min-height: 300px;
            max-height: 542px;
            max-width: 300px;
            margin-left: 0.5rem;
            transition: transform .3s cubic-bezier(.34, 2, .6, 1), box-shadow .2s ease;
        }

        .fc-head-container .fc-day-header {
            background-color: #0a2a45;
            color: white;
        }

        .fc-day-grid-container {
            margin-top: 10px !important;
        }

        .fc-widget-content {
            border: .5px solid #0a2a45 !important;
        }

        .fc-day-top {
            color: white;
            background-color: rgba(36, 66, 91, 0.86) !important;
            padding: 5px !important;
        }

        .fc-day {
            border-left: .1px solid #0a2a45 !important;
        }

        .fc-today {
            background-color: rgba(48, 78, 111, 0.15) !important;
        }

        ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 0;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: #555;
            -webkit-box-shadow: 0 0 1px hsla(0, 0%, 100%, 0.5);
        }

        .isHidden {
            display: none !important;
        }

        #event-details #event-color,
        #event-details .event-color {
            height: 5px !important;
            width: 100% !important;
            margin-bottom: 0 !important;
            background: #ccc;
        }

        #event-details #event-title {
            margin-top: 0 !important;
            letter-spacing: 0.15rem;
        }

        #eventDate {
            letter-spacing: 0.1rem;
        }

        /*#eventDate i {
          color: inherit;
        }*/
        #event-title .card > h3 {
            font-size: 22px;
            padding-bottom: 0.83rem;
            font-weight: bold;
            line-height: 1.3;
        }


        .fc td,
        .fc th {
            border-style: solid;
            border-width: 1px;
        }

        .fc-toolbar h2,
        .fc-header-title h2 {
            margin-top: 0;
            white-space: nowrap;
            font-size: 23px;
        }

        .fc-time-grid .fc-slats td {
            height: 1.75rem;
            border-bottom: 0;
        }

        .fc-time-grid .fc-slats .fc-minor td {
            border-top-style: none;
        }

        .fc-agenda-view .fc-day-grid .fc-row {
            min-height: 20px;
        }

        .fc .fc-axis {
            font-size: 0.85rem;
            vertical-align: middle;
            padding: 0 0.5rem 0 1rem;
            white-space: nowrap;
        }

        .fc-ltr .fc-axis {
            text-align: right;
        }

        .fc-event .fc-content {
            position: relative;
            z-index: 2
        }

        .fc-event .fc-content:focus {
            -webkit-box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
        }

        .fc-event, .fc-event:hover {
            color: #fff !important;
        }

        .fc-event {
            position: relative;
            display: block;
            font-size: .85em;
            line-height: 1.3;
            -webkit-border-radius: 4px;
            border-radius: 4px;
            border: 1px solid #3a87ad;
        }

        .fc-event-dot {
            width: 2px;
            height: 3rem;
            margin: 2px 10px -4px 13px;
        }

        .fc-list-view {
            overflow-y: auto;
        }

        .fc-list-table td {
            border-width: 1px 0;
        }

        .fc-ltr .fc-list-heading-main {
            float: left;
            font-size: 1.125rem;
            padding: 2px;
            margin-left: 0.5rem;
        }

        .fc-list-item-marker,
        .fc-list-item-time {
            white-space: normal;
        }

        .fc-event-dot,
        .fc-list-item-time {
            -webkit-box-flex: 0;
            -webkit-flex: 0 0 auto;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
        }


        .showEvent {
            z-index: 10;
            top: 150px;
            bottom: 0;
            margin: auto 0;
            right: 0;
            max-height: 500px !important;
        }

        .close-card-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5em;
        }

        .close-card-button:hover {
            color: rgba(192, 81, 4, 0.85);
            cursor: pointer;
        }

        .fc-left h2 {
            text-transform: capitalize;
        }

        .btn-update, .btn-cancel-update {
            margin-top: 10px;
            border: 1px solid rgba(192, 81, 4, 0.85);
            margin-bottom: 10px;
            cursor: pointer;
        }

        .btn-confirm-update {
            margin-top: 10px;
            border: 1px solid rgba(192, 81, 4, 0.85);
            margin-bottom: 10px;
            cursor: pointer;
            background-color: rgba(192, 81, 4, 0.85);
            color: white;
        }
    </style>
@endpush
