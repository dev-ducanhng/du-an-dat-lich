@extends('layouts.home')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Những bài viết mới nhất</p>
                        <h1>{{ $category_post->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- latest news -->
    <div class="latest-news mt-150 mb-150">
        <div class="container">
            @if (Session::has('message'))
                <p class="login-box-msg text-danger">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                @foreach ($posts_by_category as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news">
                            <a href="{{ route('detail-blog', [
                                'categoryPostId' => $item->categoryPost->id,
                                'categoryPostSlug' => $item->categoryPost->slug,
                                'postId' => $item->id,
                                'postSlug' => $item->slug,
                            ]) }}"
                                target="_blank">
                                <div class="latest-news-bg">
                                    <img src="{{ asset('storage/images/posts/' . $item->image) }}" alt="">
                                </div>
                            </a>
                            <div class="news-text-box">
                                <h3><a href="{{ route('detail-blog', [
                                    'categoryPostId' => $item->categoryPost->id,
                                    'categoryPostSlug' => $item->categoryPost->slug,
                                    'postId' => $item->id,
                                    'postSlug' => $item->slug,
                                ]) }}"
                                        target="_blank">{{ $item->title }}</a></h3>
                                <p class="blog-meta">
                                    <span class="author"><i class="fas fa-user"></i>{{ $item->user->name }}</span>
                                    <a class="category"
                                        href="{{ route('blog-category', [
                                            'categoryPostId' => $item->categoryPost->id,
                                            'categoryPostSlug' => $item->categoryPost->slug,
                                        ]) }}"><i
                                            class="fas fa-address-book"></i>{{ $item->categoryPost->name }}</a>
                                    <span class="date"><i class="fas fa-calendar"></i>
                                        {{ date('H:i d/m/Y', strtotime($item->created_at)) }}</span>
                                </p>

                                <a href="{{ route('detail-blog', [
                                    'categoryPostId' => $item->categoryPost->id,
                                    'categoryPostSlug' => $item->categoryPost->slug,
                                    'postId' => $item->id,
                                    'postSlug' => $item->slug,
                                ]) }}"
                                    target="_blank" class="read-more-btn">Chi tiết <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="pagination-wrap">
                                <ul>
                                    <li><a href="#">Prev</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a class="active" href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end latest news -->

    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->
@endsection
