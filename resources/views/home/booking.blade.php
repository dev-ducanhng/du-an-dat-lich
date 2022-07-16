@extends('layouts.home')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Đặt lịch</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    {{--    form booking--}}
    <div class="container">
        <form class="form-book">
            <div class="row">
                {{--                phone--}}
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                {{--                name--}}
                <div class="form-group col-6">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                {{--                số lượng--}}
                <div class="form-group col-6">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                {{--                stylist--}}
                <div class="form-group col-6">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                {{--  dịch vụ--}}
                <div class="form-group col-6">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                {{--    thời gian đặt lịch --}}
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">

                </div>

                {{-- chọn khung giờ--}}
                <div class="form-group col-2">
                    <button>
                    <p>9:30</p>
                        <span>Hết chỗ</span>
                    </button>
                </div>
                <div class="form-group col-2">
                    <button>
                        <p>9:30</p>
                        <span>Hết chỗ</span>
                    </button>
                </div>
                <div class="form-group col-2">
                    <button>
                        <p>9:30</p>
                        <span>Hết chỗ</span>
                    </button>
                </div>
                <div class="form-group col-2">
                    <button>
                        <p>9:30</p>
                        <span>Hết chỗ</span>
                    </button>
                </div>
                <div class="form-group col-2">
                    <button>
                        <p>9:30</p>
                        <span>Hết chỗ</span>
                    </button>
                </div>
                <div class="form-group col-2">
                    <button>
                        <p>9:30</p>
                        <span>Hết chỗ</span>
                    </button>
                </div>
                <div class="form-group col-2">
                    <button>
                        <p>9:30</p>
                        <span>Hết chỗ</span>
                    </button>
                </div>

                {{-- Ghi chú--}}
                <div class="form-group col-12">
                    <textarea class="w-100" name="" id="" cols="30" rows="4" placeholder="Ghi chú"></textarea>
                </div>

{{--                submit--}}
                <div class="form-group col-12">
                    <button type="button" class="btn btn-lg btn-primary" disabled>Primary button</button>
                </div>

            </div>


        </form>

    </div>
@endsection
