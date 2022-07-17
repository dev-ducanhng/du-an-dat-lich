@extends('layouts.home')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Lịch sử</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="group-profile">
                <img src="https://media.gettyimages.com/photos/actor-katie-holmes-poses-for-a-photo-with-lobby-signage-during-img-picture-id917483058?s=612x612" alt="">
                <div class="text">
                    <h3>Duy</h3>
                    <p>123@gmail.com</p>
                </div>

            </div>
        </div>
        <div class="col-6">
            <div class="gr-button">
                <button type="button" class="btn btn-primary btn-lg stt"><i class="fas fa-solid fa-pen"></i></i>Sửa thông tin</button>
                <button type="button" class="btn btn-primary btn-lg lout"><i class="fas fa-regular fa-power-off"></i>Logout</button>
            </div>
        </div>
        <div class="col-4">
            <div class="gr-his">
                <i class="fas fa-regular fa-calendar "></i>
                <p>Lịch sử đặt lịch</p>
            </div>
        </div>
    </div>

{{--    table--}}
<div class="row">
    <div class="col-3">
        <div class="gr-title">
            <h3>Lịch sử đặt lịch</h3>
        </div>
    </div>
    <div class="col-9">
        <div class="gr-date">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" id="form1" class="form-control" placeholder="search " />
                </div>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="cart-table-wrap">
            <table class="cart-table">
                <thead class="cart-table-head">
                <tr class="table-head-row">
                    <th class="product-image">STT</th>
                    <th class="product-image">Thợ cắt</th>
                    <th class="product-name">Gía dịch vụ</th>
                    <th class="product-price">Thời gian</th>
                    <th class="product-quantity">Ngày cắt</th>
                    <th class="product-total">Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-body-row">
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                </tr>
                <tr class="table-body-row">
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                    <td class="product-name">Strawberry</td>
                </tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination float-right">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>

</div>
</div>

@endsection
