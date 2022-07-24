<div class="menu" style="z-index: 10;">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li>
                    <a href="#statistic">
                        <i class="iconsminds-statistic"></i> Thống kê
                    </a>
                </li>
                <li>
                    <a href="{{route('service.index')}}">
                        <i class="iconsminds-air-balloon-1"></i> Dịch vụ
                    </a>
                </li>
                <li>
                    <a href="{{route('dashboard.booking.list')}}">
                        <i class="iconsminds-calendar-4"></i> Đặt lịch
                    </a>
                </li>
                <li>
                    <a href="#user">
                        <i class="iconsminds-conference"></i> Người dùng
                    </a>
                </li>
                <li>
                    <a href="#discount">
                        <i class="iconsminds-flash-2"></i> Giảm giá
                    </a>
                </li>
                <li>
                    <a href="#feedback">
                        <i class="iconsminds-speach-bubble-3"></i> Phản hồi
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="user">
                <li class="active">
                    <a href="{{route('dashboard.user.list')}}">
                        <i class="iconsminds-business-man-woman"></i> <span class="d-inline-block">Quản lý nhân viên</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('dashboard.role.list')}}">
                        <i class="iconsminds-key"></i> <span class="d-inline-block">Quản lý truy cập</span>
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled" data-link="discount">
                <li class="active">
                    <a href="{{route('dashboard.discount.list')}}">
                        <i class="iconsminds-business-man-woman"></i> <span class="d-inline-block">Quản lý mã giảm giá</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
