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
{{--                        <div class="text-zero top-right-button-container">--}}
{{--                            <a href="{{route('dashboard.user.create')}}"--}}
{{--                               class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm phản hồi</a>--}}
{{--                        </div>--}}

                    </div>
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="mb-2">
                        <div class="collapse d-md-block" id="displayOptions">
                            <form action="">
                                <div class="d-block d-md-inline-block">
                                    <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                        <input name="search-key" placeholder="Search..."
                                               value="{{request('search-key')}}">
                                    </div>
                                    <div class="d-inline-block float-md-left mr-1 mb-1 align-top">
                                        <button class="text-white outline-0 border-0"
                                                style="padding: 4px 35px; border-radius: 20px; background-color: #ed7117"
                                                type="submit">Lọc
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 list">
                    @foreach($feedbacks as $feedback)
                        <div class="card d-flex flex-row mb-3">
{{--                            <a class="d-flex align-items-center ml-2">--}}
{{--                                <img src="{{ asset('storage/images/users/' . $feedback->image)}}" alt="Fat Rascal"--}}
{{--                                     class="list-thumbnail responsive border-0 "/>--}}
{{--                            </a>--}}
                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                    <a class="w-40 w-sm-100">
                                        <p class="list-item-heading mb-0 truncate">{{$feedback->name}}</p>
                                    </a>
                                    <p class="list-item-heading mb-0 truncate">{{$feedback->phone_number}}</p>

                                    <p class="mb-0 text-muted text-small w-15 w-sm-100">{{$feedback->rating}}</p>
                                    <p class="mb-0 text-muted text-small w-15 w-sm-100">{{$feedback->content}}</p>

                                </div>
                                <div class="btn-group">
                                    <button
                                        class="btn d-flex justify-content-center align-items-center  dropdown-toggle"
                                        style="vertical-align: center" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tùy chọn
                                    </button>
                                    <div class="dropdown-menu mr-5">

                                        <a class="dropdown-item"
                                           href="{{route('dashboard.feedback.remove',['id'=>$feedback->id])}}"><i
                                                class="iconsminds-eraser-2"></i> Xóa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
{{--            <div class="mt-2">--}}
{{--                {{$feedbacks->links()}}--}}
{{--            </div>--}}
        </div>
    </main>
@endsection

