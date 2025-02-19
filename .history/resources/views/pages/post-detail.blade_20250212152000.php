@extends('layouts.master')

@section('title', 'Chi Tiết Bài Viết')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">{{ $post->title }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Blog Single -->
    <section class="blog-single section">
        <div class="container">
            <div class="row">
                <!-- Bài viết -->
                <div class="col-lg-8 col-12">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                <div class="image">
                                    <img src="{{ asset($post->photo) }}" alt="{{ $post->title }}" class="img-fluid">
                                </div>
                                <div class="blog-detail">
                                    <h2 class="blog-title">{{ $post->title }}</h2>
                                    <div class="blog-meta">
                                        <span class="author">
                                            <i class="fa fa-user"></i> {{ $post->author_info->name ?? 'N/A' }} |
                                            <i class="fa fa-calendar"></i> {{ $post->created_at->format('d M, Y') }} |
                                            <i class="fa fa-folder"></i> {{ $post->cat_info->title ?? 'Chưa phân loại' }}
                                        </span>
                                    </div>
                                    <div class="content">
                                        {!! $post->description !!}
                                    </div>
                                </div>

                                <!-- Chia sẻ mạng xã hội -->
                                <div class="share-social mt-4">
                                    <div class="sharethis-inline-share-buttons"></div>
                                </div>

                                <!-- Tags -->
                                <div class="content-tags mt-4">
                                    <h4>Thẻ:</h4>
                                    <ul class="tag-inner">
                                        @php
                                            $tags = explode(',', $post->tags);
                                        @endphp
                                        @foreach ($tags as $tag)
                                            <li><a href="javascript:void(0);">{{ $tag }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Bình luận -->
                                <div class="comments mt-5">
                                    <h3 class="comment-title">Bình luận ({{ $comments->count() }})</h3>

                                    <!-- Hiển thị bình luận -->
                                    <div class="comment-list">
                                        @foreach ($comments as $comment)
                                            <div class="single-comment">
                                                <div class="comment-avatar">
                                                    <img src="{{ asset('path/to/default-avatar.jpg') }}" alt="Avatar">
                                                </div>
                                                <div class="comment-body">
                                                    <div class="comment-meta">
                                                        <span
                                                            class="comment-author">{{ $comment->author_info->name ?? 'N/A' }}</span>
                                                        <span
                                                            class="comment-date">{{ $comment->created_at->format('M d, Y') }}</span>
                                                    </div>
                                                    <p class="comment-text">{{ $comment->body }}</p>

                                                    <!-- Trả lời bình luận -->
                                                    <div class="comment-reply">
                                                        <a href="javascript:void(0);" class="btn-reply reply"
                                                            data-id="{{ $comment->id }}">Trả lời</a>
                                                    </div>
                                                </div>

                                                <!-- Trả lời các bình luận -->
                                                @if ($comment->replies)
                                                    <div class="comment-replies pl-4">
                                                        @foreach ($comment->replies as $reply)
                                                            <div class="single-comment">
                                                                <div class="comment-avatar">
                                                                    <img src="{{ asset('path/to/default-avatar.jpg') }}"
                                                                        alt="Avatar">
                                                                </div>
                                                                <div class="comment-body">
                                                                    <div class="comment-meta">
                                                                        <span
                                                                            class="comment-author">{{ $reply->author_info->name ?? 'N/A' }}</span>
                                                                        <span
                                                                            class="comment-date">{{ $reply->created_at->format('M d, Y') }}</span>
                                                                    </div>
                                                                    <p class="comment-text">{{ $reply->body }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Form bình luận -->
                                @auth
                                    <div class="reply mt-4">
                                        <h2 class="reply-title">Để lại bình luận</h2>
                                        <form action="{{ route('post-comment.store', $post->slug) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Tin nhắn của bạn<span>*</span></label>
                                                <textarea name="comment" rows="5" class="form-control" placeholder="Nhập bình luận..."></textarea>
                                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                            </div>
                                            <div class="form-group button mt-3">
                                                <button type="submit" class="btn btn-primary">Đăng bình luận</button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <p class="p-4 text-center">
                                        Bạn cần phải <a href="{{ route('login') }}" class="text-primary">đăng nhập</a> hoặc
                                        <a href="{{ route('register') }}" class="text-primary">đăng ký</a> để bình luận.
                                    </p>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Danh mục -->
                        <div class="single-widget category">
                            <h3 class="title">Danh mục bài viết</h3>
                            <ul class="categor-list">
                                @foreach ($categories as $cat)
                                    <li><a href="#">{{ $cat->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Bài viết gần đây -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Bài viết gần đây</h3>
                            @foreach ($recent_posts as $post)
                                <div class="single-post">
                                    <div class="image">
                                        <img src="{{ asset($post->photo) }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="content">
                                        <h5><a
                                                href="{{ route('post.detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                        </h5>
                                        <ul class="comment">
                                            <li><i class="fa fa-calendar"></i> {{ $post->created_at->format('d M, Y') }}
                                            </li>
                                            <li><i class="fa fa-user"></i> {{ $post->author_info->name ?? 'N/A' }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Blog Single -->

@endsection
