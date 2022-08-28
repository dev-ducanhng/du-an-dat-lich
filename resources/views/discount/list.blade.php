<style>
    .row .view-pager {
        display: none;
    }
</style>

@extends('layouts.dashboard')
@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Danh sách mã giảm giá</h1>
                    @if (Session::has('message'))
                        <p class="login-box-msg text-success">{{ Session::get('message') }}</p>
                    @endif
                    <div class="text-zero top-right-button-container">
                        <a href="{{ route('dashboard.discount.create') }}"
                            class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm mã giảm giá</a>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12 data-tables-hide-filter">
                    <div class="card">
                        <div class="card-body">
                            <table class="data-table data-tables-pagination responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên mã giảm giá</th>
                                        <th>Mã giảm giá</th>
                                        <th>Phần trăm giảm giá</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Trạng thái</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discounts as $item)
                                        <tr>
                                            <td>
                                                <p class="list-item-heading">
                                                    {{ ($discounts->currentPage() - 1) * $discounts->perPage() + $loop->iteration }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="list-item-heading">{{ $item->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ $item->code_discount }}</p>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ $item->percent }} %</p>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ date('d-m-Y', strtotime($item->start_date)) }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-muted">{{ date('d-m-Y', strtotime($item->end_date)) }}</p>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-pill {{ strtotime($item->end_date) < strtotime(date('d-m-Y')) ? 'badge-warning' : 'badge-success' }}">
                                                    {{ strtotime($item->end_date) < strtotime(date('d-m-Y')) ? 'Hết hạn' : 'Còn hạn' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.discount.edit', $item->id) }}">
                                                    <i class="iconsminds-pen-2"></i>Sửa
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                {{ $discounts->links() }}
            </div>
        </div>
    </main>
@endsection
