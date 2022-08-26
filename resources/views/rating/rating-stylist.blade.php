@extends('layouts.home')
@section('content')
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>

    <style>
        div.stars {
            width: 270px;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked~label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }

        input.star-5:checked~label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked~label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }
    </style>

    <div class="contact-from-section mt-150 mb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Phản hồi về dịch vụ</h2>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" action="">
                            @csrf
                            <p>
                                <input type="text" name="stylist_id" id="name"
                                    value="{{ $array_slylist_name[$booking->stylist] }}" disabled>
                            </p>
                            <p>
                                <input style="width: 100%" type="text" name="phone" id="phone"
                                    value="{{ $array_stylist_phone[$booking->stylist] }}" disabled>
                            </p>
                            <p>
                                <textarea name="content" id="content" cols="30" rows="10" placeholder="Gửi nội dung phản hồi"></textarea>
                            </p>
                            <p>
                            <div class="stars">
                                <input class="star star-5" id="star-5" type="radio" value="5" name="rating" />
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" id="star-4" type="radio" value="4" name="rating" />
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" id="star-3" type="radio" value="3" name="rating" />
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" id="star-2" type="radio" value="2" name="rating" />
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" id="star-1" type="radio" value="1" name="rating" />
                                <label class="star star-1" for="star-1"></label>
                            </div>
                            </p>
                            <input type="hidden" name="token" value="FsWga4&@f6aw" />
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-wrap">
                        @if (strpos($array_stylist_avatar[$booking->stylist], 'user-default-avatar.jpg') != false)
                            <img src="{{ asset($array_stylist_avatar[$booking->stylist]) }}" id="output" class="mt-2 rounded-circle"
                                width="100%" />
                        @else
                            <img src="{{ asset('storage/images/users/' . $array_stylist_avatar[$booking->stylist]) }}" id="output"
                                class="mt-2 rounded-circle" width="100%" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
