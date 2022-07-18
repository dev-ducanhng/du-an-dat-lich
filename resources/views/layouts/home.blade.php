
@include('layouts.includes.head')
<div class="wrapper">
    @include('layouts.includes.header')
    <main class="page-content">
        @yield('content')
    </main>
</div>
@include('layouts.includes.footer')
