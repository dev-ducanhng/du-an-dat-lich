<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="{{ route('index') }}">
                            ISALON
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item"><a href="{{ route('index') }}">Home</a>

                            </li>
                            <li><a href="{{ route('introduce') }}">Giới thiệu</a></li>
                            <li><a href="{{ route('list-service') }}">Dịch vụ</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a>
                            </li>

                            <li><a href="{{ route('contact') }}">Liên hệ</a>

                            </li>
                            <li class="float-right">
                                <div class="header-icons">
                                    <a class="shopping-cart"
                                        href="javascript:;">{{ auth()->user() ? auth()->user()->name : '' }}<i
                                            class="fa fa-user-circle-o w-20 h-20"></i>
                                    </a>
                                    <ul class="sub-menu">
                                        @if (!auth()->user())
                                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                            <li><a href="{{ route('register') }}">Đăng ký</a></li>
                                        @endif
                                        <li><a href="{{ route('history') }}">Lịch sử</a></li>
                                        @if (auth()->user() && \Illuminate\Support\Facades\Auth::user()->role_id == \App\Models\User::ADMIN_ROLE)
                                            <li><a href="{{ route('dashboard.index') }}">Quản trị</a></li>
                                        @endif
                                        @if (auth()->user())
                                            <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
