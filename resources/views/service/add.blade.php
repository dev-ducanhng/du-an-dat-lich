

@extends('layouts.dashboard')
@section('content')
    <main style="z-index: -1000">
        <div class="row">
            <div class="col-12 mb-4">
                <h5 class="mb-4">Thêm dịch vụ</h5>
                <div class="card mb-4">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div style="z-index: 1">
                            <div class="card-body p-3">
                                <div class="form-group position-relative error-l-100">
                                    <input class="form-control" name="name"
                                           placeholder="Nhập tên ..." value="{{old('name')}}">
                                    @error('name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group position-relative error-l-100">
                                    <input type="number" class="form-control" name="price"
                                           placeholder="Nhập giá tiền..." value="{{old('price')}}">
                                    @error('price')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                               
                                <div class="form-group position-relative error-l-75">
                                    <input type="number" class="form-control" name="discount" placeholder="Nhập giảm giá ..."
                                           value="{{old('discount')}}">
                                    @error('discount')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group has-float-label w-100">
                                    <select class="form-control select2-single" name="status">
                                        <option value="1" @if(request()->old('status') == 1) selected @endif>Kíc hoạt</option>
                                        <option value="0" @if(request()->old('status') == 0) selected @endif>Không kíc hoạt</option>
                                    </select>
                                    <span>Trạng thái</span>
                                </div>
                               
                                
                                <input type="file"  name="image" >
                                @error('image')
                                <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="btn-toolbar custom-toolbar text-center card-body mb-5">
                                <button class="btn btn-secondary ml-2" type="submit">Hoàn thành</button>
                                <button class="btn btn-warning ml-2" type="button">Hủy</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

