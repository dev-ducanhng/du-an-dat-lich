<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style>
    .spacing_comment {
        width: 100%;
        background: #E5E5E5;
        height: 20px;
        margin: 50px 0;
    }

    .div_comment {
        margin-top: 20px;
    }

    .avatar_user {
        text-align: center
    }

    .content_style {
        width: 100%;
        padding: 10px;
        border: 1px solid #b0b0b0;
    }

    .info_comment {
        display: flex;
    }

    .detail_comment {
        margin-bottom: 20px;
    }

    .info_user_name {
        margin-right: 10px;
        font-size: 18px;
        font-weight: 500;
    }

    .time_comment {
        margin-top: 5px !important;
    }

    .h5_style {
        text-align: center
    }
</style>

@extends('layouts.home')
@section('content')
    <div class="mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-article-section">
                        <div class="single-article-text">
                            <h2>{{ $post->title }}</h2>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i>{{ $post->user->name }}</span>
                                <a class="category"
                                    href="{{ route('blog-category', [
                                        'categoryPostId' => $post->categoryPost->id,
                                        'categoryPostSlug' => $post->categoryPost->slug,
                                    ]) }}"><i
                                        class="fas fa-address-book"></i>{{ $post->categoryPost->name }}</a>
                                <span class="date"><i class="fas fa-calendar"></i>
                                    {{ date('H:i d/m/Y', strtotime($post->created_at)) }}</span>
                            </p>
                            <div>
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="spacing_comment"></div>
                    <div class="div_comment">
                        <h4>Bình luận</h4>
                        @if (auth()->user())
                            <div class="comment" dt-id='{{ auth()->user()->id }}'>
                                <div class="row">
                                    <div class="col-2 avatar_user">
                                        @if (strpos(auth()->user()->avatar, 'user-default-avatar.jpg') != false)
                                            <img src="{{ asset(auth()->user()->avatar) }}" id="output"
                                                class="mt-2 rounded-circle" width="75%" />
                                        @else
                                            <img src="{{ asset('storage/images/users/' . auth()->user()->avatar) }}"
                                                id="output" class="mt-2 rounded-circle" width="75%" />
                                        @endif
                                    </div>
                                    <div class="col-10 box_comment">
                                        <form action="{{ route('send-comment') }}" method="post">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="post_id" id="post_id"
                                                value="{{ $post->id }}">
                                            <input type="hidden" name="user_id" id="user_id"
                                                value="{{ auth()->user()->id }}">
                                            <textarea name="content" class="content_style" rows="5" id="content"></textarea>
                                            @error('content')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                            <button type="submit" class="btn btn-primary mt-2"
                                                onClick="return confirm('Bạn muốn gửi bình luận chứ?');">Gửi bình
                                                luận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h5 class="h5_style">Hãy <a href="{{ route('login') }}">đăng nhập</a> để gửi bình luận</h5>
                        @endif
                        <div class="list_comment">
                            @foreach ($comment_by_post as $item)
                                <div class="detail_comment" dt-id="{{ $item->id }}">
                                    <div class="info_comment">
                                        <a href="javascript:;" class="info_user_name">{{ $item->user->name }}</a>
                                        <p class="time_comment">{{ date('H:i d/m/Y', strtotime($item->created_at)) }}</p>
                                    </div>
                                    <div class="content_comment">
                                        <p>{{ $item->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-section">
                        <div class="recent-posts">
                            <h4>NHIỀU LƯỢT XEM NHẤT</h4>
                            <ul>
                                @foreach ($other_post_most_view as $item)
                                    <li><a
                                            href="{{ route('detail-blog', [
                                                'categoryPostId' => $item->categoryPost->id,
                                                'categoryPostSlug' => $item->categoryPost->slug,
                                                'postId' => $item->id,
                                                'postSlug' => $item->slug,
                                            ]) }}">{{ $item->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="recent-posts">
                            <h4>CÙNG CHUYÊN MỤC</h4>
                            <ul>
                                @foreach ($other_post_by_category_id as $item)
                                    <li><a
                                            href="{{ route('detail-blog', [
                                                'categoryPostId' => $item->categoryPost->id,
                                                'categoryPostSlug' => $item->categoryPost->slug,
                                                'postId' => $item->id,
                                                'postSlug' => $item->slug,
                                            ]) }}">{{ $item->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        $('.btn_send').click(function() {
            var _token = $('#token').val();
            var categoryPostId = {{ $post->category_post_id }};
            var postId = {{ $post->id }};
            var userId = $('.comment').attr('dt-id');
            var content = $('#comment').val();
            console.log(_token, content, categoryPostId, userId, postId);
            $.ajax({
                url: '/send-comment',
                data: {
                    _token: _token,
                    categoryPostId: categoryPostId,
                    postId: postId,
                    userId: userId,
                    content: content,
                },
                type: 'POST',
            });

        });
    });
</script>
