<div class="menu" style="z-index: 10;">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <i class="iconsminds-statistic"></i> Thống kê
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.service.index') }}">
                        <i class="iconsminds-air-balloon-1"></i> Dịch vụ
                    </a>
                </li>
                <li>
                    <a href="#booking">
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
                    <a href="#post">
                        <i class="iconsminds-speach-bubble-4"></i> Bài viết
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.feedback.index') }}">
                        <i class="iconsminds-speach-bubble-3"></i> Phản hồi
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="user">
                <li>
                    <a href="{{ route('dashboard.user.list') }}">
                        <i class="iconsminds-business-man-woman"></i> <span class="d-inline-block">Quản lý nhân
                            viên</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.role.list') }}">
                        <i class="iconsminds-key"></i> <span class="d-inline-block">Quản lý truy cập</span>
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled" data-link="discount">
                <li>
                    <a href="{{ route('dashboard.discount.list') }}">
                        <i class="iconsminds-business-man-woman"></i> <span class="d-inline-block">Quản lý mã giảm
                            giá</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="post">
                <li>
                    <a href="{{ route('dashboard.category-post.list') }}">
                        <i class="iconsminds-business-man-woman"></i> <span class="d-inline-block">Danh mục bài
                            viết</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.post.list') }}">
                        <i class="iconsminds-business-man-woman"></i> <span class="d-inline-block">Danh sách bài
                            viết</span>
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled" data-link="booking">
                <li>
                    <a href="{{ route('dashboard.booking.index') }}">
                        <i class="iconsminds-letter-open"></i> <span class="d-inline-block">Xem thông thường</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.booking.list') }}">
                        <i class="iconsminds-calendar-4"></i> <span class="d-inline-block">Xem theo lịch</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
