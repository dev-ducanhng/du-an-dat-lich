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
                                <span class="category"><i
                                        class="fas fa-address-book"></i>{{ $post->categoryPost->name }}</span>
                                <span class="date"><i class="fas fa-calendar"></i>
                                    {{ date('H:i d/m/Y', strtotime($post->created_at)) }}</span>
                            </p>
                            <div>
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-section">
                        <div class="recent-posts">
                            <h4>Recent Posts</h4>
                            <ul>
                                <li><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></li>
                                <li><a href="single-news.html">A man's worth has its season, like tomato.</a></li>
                                <li><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></li>
                                <li><a href="single-news.html">Fall in love with the fresh orange</a></li>
                                <li><a href="single-news.html">Why the berries always look delecious</a></li>
                            </ul>
                        </div>

                        {{-- <div class="tag-section">
                        <h4>Tags</h4>
                        <ul>
                            <li><a href="single-news.html">Apple</a></li>
                            <li><a href="single-news.html">Strawberry</a></li>
                            <li><a href="single-news.html">BErry</a></li>
                            <li><a href="single-news.html">Orange</a></li>
                            <li><a href="single-news.html">Lemon</a></li>
                            <li><a href="single-news.html">Banana</a></li>
                        </ul>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
