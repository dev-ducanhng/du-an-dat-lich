
@include('layouts.admin.head')
<div class="wrapper">
    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')
    @yield('content')
</div>
@include('layouts.admin.footer')
