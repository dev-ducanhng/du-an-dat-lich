@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-2 mb-5"></div>
                <div class="col-8 mb-5">
                    <h5 class="mb-5">Thêm phiếu giảm giá</h5>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="" method="POST" class="needs-validation tooltip-label-right" novalidate="">
                                @csrf
                                <div class="form-group position-relative error-l-50">
                                    <label>Tên mã giảm giá</label>
                                    <input type="text" name="name" id="name" class="input-sm form-control"
                                        required="">
                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group position-relative error-l-50">
                                    <label>Mã giảm giá (Mã giảm giá có 8 ký tự)</label>
                                    <input type="text" name="code_discount" id="code_discount"
                                        class="input-sm form-control" required="">
                                        <a href="javascript:;" onclick="makeid(8)">Tạo mã giảm giá ngẫu nhiên</a>
                                    @error('code_discount')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group position-relative error-l-50">
                                    <label>Phần trăm giảm giá (%)</label>
                                    <input type="number" name="percent" min="0" max="100"
                                        class="input-sm form-control" required="">
                                    @error('percent')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label>Thời hạn giảm giá</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="start_date"
                                            placeholder="Ngày bắt đầu">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="input-sm form-control" name="end_date"
                                            placeholder="Ngày kết thúc">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mb-0">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-2 mb-5"></div>
            </div>
        </div>
    </main>
@endsection
@push('javascript')
    <script>
        function makeid(length) {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < length; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            document.getElementById('code_discount').setAttribute('value', text);
        }

        mobiscroll.setOptions({
            theme: 'windows',
            themeVariant: 'light'
        });

        mobiscroll.datepicker('#demo-responsive-drop', {
            controls: ['date'],
            responsive: {
                xsmall: {
                    display: 'bottom'
                },
                small: {
                    display: 'anchored'
                },
                custom: { // Custom breakpoint
                    breakpoint: 800,
                    display: 'anchored',
                    touchUi: false
                }
            }
        });
        $(".dropzone").click(function() {
            $(".upload-image").click();
        });
    </script>
@endpush
