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
        @if (auth()->user())
            <div class="page-content mt-3 p-0" id="page-content">
                <div class="d-flex ">
                    <div class="col-xl-12 col-md-12">
                        <div class="card user-card-full" style="border: 1px solid #F28123;">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25 flex justify-content-center">
                                            @if (strpos($profile->avatar, 'user-default-avatar.jpg') != false)
                                                <img src="{{ asset($profile->avatar) }}" alt="avatar" class="img-radius"
                                                     style="width: 200px;">
                                            @else
                                                <img src="{{ asset('storage/images/users/' . $profile->avatar) }}"
                                                     alt="avatar" class="img-radius" style="width: 200px;">
                                            @endif
                                        </div>
                                        <div>
                                            <h4 style="font-size: 18px; font-weight: bold"
                                                class="text-black">{{ $profile->name }}</h4>
                                            <p class="py-2">{{ $profile->role->name }}</p>
                                            <div>
                                                <a href="{{ route('change-infomation') }}" class="btn btn-edit">Sửa
                                                    trang cá nhân</a>
                                                <a href="{{ route('change-password') }}"
                                                   class="btn btn-change-password">Đổi mật khẩu</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Thông tin cá nhân</h6>
                                        <div class="row">
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Tên người dùng</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->name }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Vai trò</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->role->name }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Email</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->email }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Số điện thoại</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->phone }}</h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Giới tính</p>
                                                <h6 class="text-muted f-w-400">{{ $profile->gender == 1 ? 'Nam' : 'Nữ' }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-6 m-b-10">
                                                <p class="f-w-600" style="margin-bottom: 5px;">Ngày sinh</p>
                                                <h6 class="text-muted f-w-400">
                                                    {{ date('d/m/Y', strtotime($profile->dob)) }}</h6>
                                            </div>
                                            @if ($profile->role_id == \App\Models\User::STYLIST_ROLE && $profile->total_rating != null && $profile->count_rating != null)
                                                <div class="col-sm-6 m-b-10">
                                                    <p class="f-w-600" style="margin-bottom: 5px;">Điểm đánh giá</p>
                                                    <h6 class="text-muted f-w-400">
                                                        @if (ceil($profile->total_rating / $profile->count_rating) == 1)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 2)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 3)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 4)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star"></div>
                                                        @elseif(ceil($profile->total_rating / $profile->count_rating) == 5)
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                            <div class="star star_rating_on"></div>
                                                        @endif
                                                    </h6>
                                                </div>
                                            @endif
                                        </div>
                                        <ul class="social-link list-unstyled m-t-40 m-b-10">
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                   title="" data-original-title="facebook" data-abc="true"><i
                                                        class="mdi mdi-facebook feather icon-facebook facebook"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                   title="" data-original-title="twitter" data-abc="true"><i
                                                        class="mdi mdi-twitter feather icon-twitter twitter"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                   title="" data-original-title="instagram" data-abc="true"><i
                                                        class="mdi mdi-instagram feather icon-instagram instagram"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
                                   value="{{ request()->input('phone_number') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên của bạn"
                                   value="{{ request()->input('name') }}">
                        </div>
                        <div class="text-center  mx-auto" style="width: 500px">
                            <button type="submit" class="btn button-search px-5 py-2">Tìm kiếm lịch sử đặt lịch</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="tab mt-5" role="tabpanel">
            @if (auth()->user() && auth()->user()->role_id == \App\Models\User::STYLIST_ROLE)
                <form action="" method="GET" id="filterForm" class="d-flex justify-content-between">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation">
                            <button href="#Section" type="button" class="filterList" name="filterList" role="tab"
                                    data-toggle="tab">Tất cả lịch đặt
                            </button>
                        </li>
                        <li role="presentation">
                            <button href="#Section" type="button" class="filterToday" name="filterToday" role="tab"
                                    data-toggle="tab">
                                Hôm nay
                            </button>
                        </li>
                        <li role="presentation">
                            <button href="#Section" type="button" class="filterSolve" name="filterSolve" role="tab"
                                    data-toggle="tab">Chưa cắt
                            </button>
                        </li>
                        <li role="presentation">
                            <button href="#Section" type="button" class="filterCancel" name="filterCancel" role="tab"
                                    data-toggle="tab">Khách hủy
                            </button>
                        </li>
                    </ul>
                    <input type="text" class="filterValue" value="" name="filterValue" hidden>
                    <div class="row mt-3">
                        <div class="form-group col-md-4">
                            <input id="start" type="text" class="form-control py-3"
                                   value="{{request()->query('start_date')}}" name="start_date"
                                   placeholder="Từ ngày">
                            @error('start_date')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <input id="end" placeholder="đến ngày" type="text" value="{{request()->query('end_date')}}"
                                   class="form-control py-3" name="end_date">
                            @error('end_date')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <button style="width: 100%; background: #F28123; border: none"
                                    class="text-center py-3 text-white" type="submit">Tìm kiếm
                            </button>
                        </div>
                    </div>
                </form>
            @endif

            @if((auth()->user() && auth()->user()->role_id != \App\Models\User::ADMIN_ROLE) || ! auth()->user())
                <div class="h-full py-2 mb-5">
                    <!-- Table -->
                    <div class="w-full mx-auto bg-white  rounded-sm">
                        @if (Session::has('message'))
                            <p class="login-box-msg text-success">{{ Session::get('message') }}</p>
                        @endif
                        <div class="flex justify-content-between mt-2">
                            <p class="py-2  px-10 text-white" style="background: #cf6f29; font-weight: bold">Danh sách
                                đặt
                                lịch</p>
                            @if(auth()->user() && auth()->user()->role_id == \App\Models\User::STYLIST_ROLE)
                                <p class="py-2  px-10 text-white" style="background: #cf6f29; font-weight: bold">Tổng số
                                    lịch
                                    đặt: {{$dataBookings->count() ?? 0}} </p>
                            @endif
                        </div>
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
                                                @if (auth()->user() &&
                                                    (auth()->user()->role_id == \App\Models\User::STAFF_ROLE ||
                                                        auth()->user()->role_id == \App\Models\User::MEMBER_ROLE))
                                                    <th class="p-2 whitespace-nowrap">
                                                        <div class="font-semibold text-left">Đánh giá</div>
                                                    </th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100">

                                            @if ($dataBookings && $dataBookings->count() > 0)
                                                @foreach ($dataBookings as $booking)
                                                    <tr>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class=" p-2  text-gray-800 text-left font-weight-bold">
                                                                {{ $booking->customer_name }}</div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class=" p-2  text-gray-800 text-left font-weight-bold">
                                                                {{ $booking->phone_number }}</div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="p-2 text-left text-danger ">
                                                                {{ date('d/m/Y', strtotime($booking->bookingDate->date)) }}
                                                            </div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="p-2 text-left  text-left text-danger">
                                                                {{ date('G:i', strtotime($booking->booking_time)) }}</div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="p-2 text-left  text-info text-left">
                                                                {{ $booking->Stylist->name }}</div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div class="p-2 text-left  text-green-500 text-left">
                                                                {{ $booking->present()->getListService }}</div>
                                                        </td>
                                                        <td class="py-2 whitespace-nowrap">
                                                            <div class="p-2 text-left  text-green-500 text-left">
                                                                {{ $booking->present()->getServicePrice }}</div>
                                                        </td>
                                                        <td class="p-2 whitespace-nowrap">
                                                            <div
                                                                class="p-2 text-left  badge text-white
                                                @if ($booking->status == \App\Models\Booking::SOLVED_YET) badge-warning
                                                        @elseif($booking->status == \App\Models\Booking::SOLVED_YET)
                                                                    badge-success
@else
                                                                    badge-danger @endif text-left">
                                                                {{ $booking->present()->getStatus }}</div>
                                                        </td>
                                                        @if (auth()->user() &&
                                                            (auth()->user()->role_id == \App\Models\User::STAFF_ROLE ||
                                                                auth()->user()->role_id == \App\Models\User::MEMBER_ROLE))
                                                            <td>
                                                                @if ($booking->rating != null)
                                                                    @if ($booking->rating == 1)
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                    @elseif($booking->rating == 2)
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                    @elseif($booking->rating == 3)
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                    @elseif($booking->rating == 4)
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star"></div>
                                                                    @elseif($booking->rating == 5)
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                        <div class="star star_rating_on"></div>
                                                                    @endif
                                                                @elseif($booking->rating == null && $booking->status == 0)
                                                                    <a href="{{ route('rating.rating', ['booking_id' => $booking->id]) }}"
                                                                       class="p-2 text-left badge text-white badge-primary text-left">
                                                                        Đánh giá</a>
                                                                @else
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td>
                                                            @if (auth()->user() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::STYLIST_ROLE)
                                                                <a class="with-tooltip change-status p-3 text-white"
                                                                   style="width: 20px; height: 20px; background: #cf6f29"
                                                                   data-tooltip-content="Cập nhật trạng thái"
                                                                   data-toggle="modal" data-target='#practice_modal'
                                                                   data-id="{{ $booking->id }}" id="updateStatus">
                                                                    <i class="fa fa-pencil-square-o"
                                                                       aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <div class="text-center">
                                                        <td class="text-center" colspan="12">
                                                            <div class="text-center mt-5 text-danger py-5">Bạn không có
                                                                lịch
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
                                    @if ($dataBookings)
                                        {{ $dataBookings->links() }}
                                    @endif
                                </div>
                                <div class="modal fade" id="practice_modal">
                                    <div class="modal-dialog">
                                        <p class="text-center">Cập nhật trạng thái</p>
                                        <form id="statusData" action="{{ route('update-status-booking') }}"
                                              method="POST">
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

                                                    <button type="submit" class="btn btnSubmit btn-update  ml-2 p-2"
                                                            style="width: 200px; border-radius: unset !important;"> Cập
                                                        nhật
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
            @endif
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
        let start = MCDatepicker.create({
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
        let end = MCDatepicker.create({
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
    </script>
@endpush
@push('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
    <style>
        .btn-edit {
            background: #F28123;
            color: white;
        }

        .btn-change-password {
            border: 1px solid #F28123;
        }

        .btn-change-password:hover {
            background: #F28123;
            color: white;
        }

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

        .button-search,
        .btn-update {
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

        filterForm button:hover,
        button:focus {
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

        .star {
            display: inline-block;
            background: url('star-rating/star_rating.png');
            background-repeat: no-repeat;
            width: 19px;
            min-width: 19px;
            height: 18px;
            min-height: 18px;
        }

        .star_rating_on {
            background: url('star-rating/star_rating_on.png');
        }

        .padding {
            padding: 3rem !important
        }

        .sticky-wrapper {
            position: unset;
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
            background: #dcdcdc;
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
        }

        h6 {
            font-size: 14px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px) {
            p {
                font-size: 14px;
            }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .star {
            display: inline-block;
            background: url('star-rating/star_rating.png');
            background-repeat: no-repeat;
            width: 19px;
            min-width: 19px;
            height: 18px;
            min-height: 18px;
        }

        .star_rating_on {
            background: url('star-rating/star_rating_on.png');
        }
    </style>

@endpush
