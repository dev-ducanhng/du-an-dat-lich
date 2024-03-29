<style>
    p.excerpt {
        height: auto !important;
    }

    ul {
        list-style: none;
        padding-left: 0;
    }
</style>

@extends('layouts.home')
@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Những bài viết mới nhất</p>
                        <h1>Bài viết </h1>
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
                <div class="d-none d-md-block col-12 col-md-3">
                    <div class="sidebar-section">
                        <div class="recent-posts">
                            <h4>Danh mục bài viết</h4>
                            <ul>
                                @foreach ($category_post as $item)
                                    <li><a
                                            href="{{ route('blog-category', [
                                                'categoryPostId' => $item->id,
                                                'categoryPostSlug' => $item->slug,
                                            ]) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row">
                        @foreach ($posts as $item)
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
                                        <p class="excerpt">{{ $item->short_description }}</p>

                                        <a href="{{ route('detail-blog', [
                                            'categoryPostId' => $item->categoryPost->id,
                                            'categoryPostSlug' => $item->categoryPost->slug,
                                            'postId' => $item->id,
                                            'postSlug' => $item->slug,
                                        ]) }}"
                                            target="_blank" class="read-more-btn">Chi tiết <i
                                                class="fas fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end latest news -->

    <div class="mt-2">
        {{ $posts->links() }}
    </div>
@endsection
