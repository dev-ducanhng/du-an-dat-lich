@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="icon-cards-row">
                        <div class="dashboard-numbers">
                            <div class="">
                                <ul class="row list-unstyled">
                                    <li class="col-md-3">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-clock"></i>
                                                <p class="card-text mb-0">Tổng số lịch đặt</p>
                                                <p class="lead text-center">{{$bookings->count()}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-md-3">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-male-female"></i>
                                                <p class="card-text mb-0">Tổng số stylist</p>
                                                <p class="lead text-center">{{$stylists->count()}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-md-3">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-arrow-refresh"></i>
                                                <p class="card-text mb-0">Tổng số service</p>
                                                <p class="lead text-center">{{$services->count()}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="col-md-3">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-pound"></i>
                                                <p class="card-text mb-0">Tổng doanh thu</p>
                                                <p class="lead text-center">{{number_format($totalPrice, 0, '', ",") . ' VNĐ'}}</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Pie Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        Thống kê đặt lịch theo năm
                                    </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart" width="400" height="400"
                                                class="staticByYear"
                                                data-details="{{ $months }}"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small" id="pie_chart_footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thống kê trạng thái đặt lịch thành công</h5>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"
                                            class="staticByStatusBooking"
                                            width="100%" height="400"
                                            data-details="{{ $countBookingByStatus }}"></canvas>
                                </div>
                                <div class="mt-4 text-center small" id="pie_chart_footer">

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Top stylish được đánh giá cao nhất</h5>
                            <table class="data-table data-table-standard responsive nowrap"
                                   data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                <tr>
                                    <th>Tên stylish</th>
                                    <th>Số đánh giá</th>
                                    <th>Điểm trung bình</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dataRating as $key => $rating)
                                    <tr>
                                        <td class="d-flex">
                                            @if($key == 0)
                                                <span>
                                                    <i class="iconsminds-trophy list-item-heading text-primary"></i>
                                                </span>
                                                <p class="list-item-heading text-danger">{{$rating['stylish']}}</p>

                                            @elseif($key==1)
                                                <span>
                                                    <i class="iconsminds-trophy-2 list-item-heading text-primary"></i>
                                                </span>
                                                <p class="list-item-heading text-warning">{{$rating['stylish']}}</p>

                                            @elseif($key==2)
                                                <span>
                                                    <i class="iconsminds-medal list-item-heading text-primary"></i>
                                                </span>
                                                <p class="list-item-heading">{{$rating['stylish']}}</p>
                                            @else
                                                <p class="list-item-heading">{{$rating['stylish']}}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-muted text-center">{{$rating['rating']}}</p>
                                        </td>
                                        <td>
                                            <p class="text-muted text-center">{{$rating['point']}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('javascript')
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <script>
        const staticByYear = document.querySelectorAll('.staticByYear')
        const staticByStatusBooking = document.querySelectorAll('.staticByStatusBooking')

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        Array.from(staticByYear).forEach(cxt => {
            let bookings = JSON.parse(cxt.dataset.details)
            let labels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']

            new Chart(cxt, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Thống kê đặt lịch theo từng năm',
                        data: bookings,
                        fill: false,
                        borderColor: "#00365a",
                        pointBorderColor: "#00365a"
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true
                    },
                    cutoutPercentage: 80,
                },
            });
        })

        Array.from(staticByStatusBooking).forEach(cxt => {
            let bookings = JSON.parse(cxt.dataset.details)
            let labels = bookings.map(item => {
                return item.month_name
            })
            let backgroundColor = bookings.map(item => {
                return getRandomColor()
            })
            let data = bookings.map(item => {
                return item.count
            })

            new Chart(cxt, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Thống kê đặt lịch theo từng năm',
                        data: data,
                        fill: false,
                        backgroundColor: backgroundColor
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    },
                    cutoutPercentage: 80,
                },
            });
        })
    </script>

@endpush
