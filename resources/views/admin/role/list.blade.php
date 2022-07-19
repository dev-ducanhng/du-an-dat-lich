@extends('layouts.dashboard')
@section('content')
    @php
        $authUser = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <main>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        @if($authUser->role_id == \App\Models\User::ADMIN_ROLE)
                        <div class="text-zero top-right-button-container">
                            <a href="{{route('dashboard.role.create')}}"  class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm chức vụ</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">Quản lý chức vụ</h5>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên quyền truy cập</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{$role->id}}</th>
                                <td class="text-uppercase">{{$role->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
