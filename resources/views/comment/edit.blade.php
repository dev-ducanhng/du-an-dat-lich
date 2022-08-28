@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-2 mb-5"></div>
                <div class="col-8 mb-5">
                    <h5 class="mb-5">Sủa trạng thái bình luận</h5>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="" method="POST" class="needs-validation tooltip-label-right" novalidate="">
                                @csrf
                                <div class="form-group position-relative error-l-50">
                                    <label>Trạng thái bình luận</label>
                                    <select name="is_show" class="form-control select2-single" data-width="100%">
                                        <option value="1" @if ($comment->is_show == 1) selected @endif>Hiện
                                        </option>
                                        <option value="0" @if ($comment->is_show == 0) selected @endif>Ẩn</option>
                                    </select>
                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mb-0">Sửa</button>
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
