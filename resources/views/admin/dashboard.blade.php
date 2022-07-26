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
                                    <li  class="col-md-3">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-male-female"></i>
                                                <p class="card-text mb-0">Tổng số stylist</p>
                                                <p class="lead text-center">{{$stylists->count()}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li  class="col-md-3">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-arrow-refresh"></i>
                                                <p class="card-text mb-0">Tổng số service</p>
                                                <p class="lead text-center">{{$services->count()}}</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li  class="col-md-3">
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
                                                data-details = "{{ $countBookingPerMonth }}"></canvas>
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
                <div class="col-lg-4 col-sm-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thống kê trạng thái đặt lịch thành công</h5>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"
                                            class="staticByStatusBooking"
                                            width="100%" height="400"
                                            data-details = "{{ $countBookingByStatus }}"></canvas>
                                </div>
                                <div class="mt-4 text-center small" id="pie_chart_footer">

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card dashboard-sq-banner justify-content-end">
                        <div class="card-body justify-content-end d-flex flex-column">
                            <span class="badge badge-pill badge-theme-3 align-self-start mb-3">DORE</span>
                            <p class="lead text-white">MAGIC IS IN THE DETAILS</p>
                            <p class="text-white">Yes, it is indeed!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card dashboard-link-list">
                        <div class="card-body">
                            <h5 class="card-title">Cakes</h5>
                            <div class="d-flex flex-row">
                                <div class="w-50">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1">
                                            <a href="#">Marble Cake</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Fruitcake</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Chocolate Cake</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Fat Rascal</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Financier</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Genoise</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Gingerbread</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Goose Breast</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Parkin</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Petit Gâteau</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Salzburger Nockerl</a>
                                        </li>
                                        <li>
                                            <a href="#">Soufflé</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="w-50">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1">
                                            <a href="#">Streuselkuchen</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Tea Loaf</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Napoleonshat</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Merveilleux</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Magdalena</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Cremeschnitte</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Cheesecake</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Bebinca</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Fruitcake</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Chocolate Cake</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Fat Rascal</a>
                                        </li>
                                        <li class="mb-1">
                                            <a href="#">Financier</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="row sortable">
                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header p-0 position-relative">
                            <div class="position-absolute handle card-icon">
                                <i class="simple-icon-shuffle"></i>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Payment Status</h6>
                            <div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                 data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
                                 data-show-percent="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header p-0 position-relative">
                            <div class="position-absolute handle card-icon">
                                <i class="simple-icon-shuffle"></i>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Work Progress</h6>
                            <div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                 data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="64"
                                 data-show-percent="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header p-0 position-relative">
                            <div class="position-absolute handle card-icon">
                                <i class="simple-icon-shuffle"></i>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Tasks Completed</h6>
                            <div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                 data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="75"
                                 data-show-percent="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header p-0 position-relative">
                            <div class="position-absolute handle card-icon">
                                <i class="simple-icon-shuffle"></i>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Payments Done</h6>
                            <div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                 data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="32"
                                 data-show-percent="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="card dashboard-filled-line-chart">
                        <div class="card-body ">
                            <div class="float-left float-none-xs">
                                <div class="d-inline-block">
                                    <h5 class="d-inline">Website Visits</h5>
                                    <span class="text-muted text-small d-block">Unique Visitors</span>
                                </div>
                            </div>
                            <div class="btn-group float-right float-none-xs mt-2">
                                <button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    This Week
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">This Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="chart card-body pt-0">
                            <canvas id="visitChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="card dashboard-filled-line-chart">
                        <div class="card-body ">
                            <div class="float-left float-none-xs">
                                <div class="d-inline-block">
                                    <h5 class="d-inline">Conversion Rates</h5>
                                    <span class="text-muted text-small d-block">Per Session</span>
                                </div>
                            </div>
                            <div class="btn-group float-right mt-2 float-none-xs">
                                <button class="btn btn-outline-secondary btn-xs dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    This Week
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">This Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="chart card-body pt-0">
                            <canvas id="conversionChart"></canvas>
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
            let labels = bookings.map(item => {
                return item.month_name
            })

            let data = bookings.map(item => {
                return item.count
            })

            new Chart(cxt, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Thống kê đặt lịch theo từng năm',
                        data: data,
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
