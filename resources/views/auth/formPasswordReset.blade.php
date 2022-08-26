
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{asset('assets/dashboard/src/font/iconsmind-s/css/iconsminds.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/dashboard/src/font/simple-line-icons/css/simple-line-icons.css')}}"/>

    <link rel="stylesheet" href="{{asset('assets/dashboard/src/css/vendor/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/dashboard/src/css/vendor/bootstrap.rtl.only.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/dashboard/src/css/vendor/bootstrap-float-label.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/dashboard/src/css/main.css')}}"/>
    <style>
        .fixed-background {
            background: url("https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80") no-repeat !important;
            background-size: cover !important;
        }
        .image-side{
            background: url("https://images.unsplash.com/photo-1577467014381-aa7c13dbf331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80") !important;
            background-size: cover;
        }
    </style>
</head>

<body class="background show-spinner no-footer">
<div class="fixed-background"></div>
<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">SALON</p>

                        <p class="white mb-0">
                          Vui lòng nhập tài khoản của bạn để tiếp tục.
                            <br>Nếu bạn không phải thành viên, vui lòng
                            <a href="#" style="text-decoration: underline" class="white">đăng ký</a>.
                        </p>
                    </div>
                    <div class="form-side">

                        <form method="POST" action="/reset-password">
                            @csrf
                            <label class="form-group has-float-label mb-4">
                                <input class="form-control" value="{{$email}}" name="email" placeholder="Email" hidden/>
                                @error('email')
                                <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                                <input class="form-control" value="{{$token}}"  name="remember_token" hidden />
                                <p>Mật khẩu mới</p>
                                <input type="password" class="form-control"  name="password" placeholder="Mật khẩu mới" />
                                @error('password')
                                <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                                <p>Nhập lại mật khẩu</p>
                                <input type="password" class="form-control"  name="password_confirmation" placeholder="Xác nhận mật khẩu" />
                                @error('password_confirmation')
                                <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                                @if(Session::has('msg'))
                             <p class="login-box-msg text-danger">{{Session::get('msg')}}</p>
                             @endif
                            </label>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">Tiếp tục</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    const hrefStyle = "{{asset("assets/dashboard/src")}}/"
</script>
<script src="{{asset('assets/dashboard/src/js/vendor/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/dore.script.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/scripts.js')}}"></script>
</body>
</html>
