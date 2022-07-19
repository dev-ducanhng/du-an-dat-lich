<script>
    const hrefStyle = "{{asset("assets/dashboard/src")}}/"
</script>
<script src="{{asset('assets/dashboard/src/js/vendor/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/Chart.bundle.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/chartjs-plugin-datalabels.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/progressbar.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/jquery.barrating.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/select2.full.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/nouislider.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/Sortable.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/mousetrap.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/glide.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/dore.script.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/jquery.smartWizard.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/jquery.validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/jquery.validate/additional-methods.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/vendor/dropzone.min.js')}}"></script>
<script src="{{asset('assets/dashboard/src/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

<script>
    $(document).ready(function () {
        toastr.options.timeOut = 5000;
        @if (\Illuminate\Support\Facades\Session::has('error'))
        toastr.error('{{ \Illuminate\Support\Facades\Session::get('error') }}');
        @elseif(\Illuminate\Support\Facades\Session::has('success'))
        toastr.success('{{ \Illuminate\Support\Facades\Session::get('success') }}');
        @endif
    });
</script>

@stack('javascript')
</body>
</html>
