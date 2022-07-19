@extends('layouts.dashboard')
@section('content')
    @php
    $authUser = \Illuminate\Support\Facades\Auth::user();
    @endphp
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        @if($authUser->role_id == \App\Models\User::ADMIN_ROLE)
                            <div class="text-zero top-right-button-container">
                                <a href="{{route('dashboard.user.create')}}"  class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm người dùng</a>
                            </div>
                        @endif
                    </div>

                    <div class="mb-2">
                        <div class="collapse d-md-block" id="displayOptions">
                            <form action="">
                                <div class="d-block d-md-inline-block">
                                    <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                        <input name="search-key" placeholder="Search..." value="{{request('search-key')}}">
                                    </div>
                                    <div class="d-inline-block float-md-left mr-1 mb-1 align-top">
                                        <button class="text-white outline-0 border-0"
                                                style="padding: 4px 35px; border-radius: 20px; background-color: #ed7117"
                                                type="submit">Lọc</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 list" >
                    @foreach($users as $user)
                        <div class="card d-flex flex-row mb-3">
                            <a class="d-flex align-items-center ml-2">
                                <img src="{{ asset('storage/images/users/' . $user->avatar)}}" alt="Fat Rascal"
                                     class="list-thumbnail responsive border-0 " />
                            </a>
                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a  class="w-40 w-sm-100">
                                        <p class="list-item-heading mb-0 truncate">{{$user->name}}</p>
                                        <p class="list-item-heading mb-0 truncate">{{$user->email}}</p>
                                    </a>
                                    <p class="mb-0 text-muted text-small w-15 w-sm-100">{{$user->role->name}}</p>
                                    <p class="mb-0 text-muted text-small w-15 w-sm-100">{{$user->phone}}</p>
                                    <div class="w-15 w-sm-100">
                                        <span class="badge badge-pill {{$user->status == \App\Models\User::ACTIVE ? 'badge-success' : 'badge-primary'}}">
                                            {{$user->status == \App\Models\User::ACTIVE ? 'Hoạt động' : 'Không hoạt động'}}
                                        </span>
                                    </div>
                                </div>
                                @if($authUser->role_id == \App\Models\User::ADMIN_ROLE)

                                <div class="btn-group">
                                    <button class="btn d-flex justify-content-center align-items-center  dropdown-toggle" style="vertical-align: center" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tùy chọn
                                    </button>
                                    <div class="dropdown-menu mr-5">
                                        <a class="dropdown-item" href="{{route('dashboard.user.edit', $user->id)}}"><i class="iconsminds-pen-2"></i> Sửa</a>
                                        <a class="dropdown-item" href="{{route('dashboard.user.delete', $user->id)}}"><i class="iconsminds-eraser-2"></i> Xóa</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-2">
                {{$users->links()}}
            </div>
        </div>
    </main>
@endsection
