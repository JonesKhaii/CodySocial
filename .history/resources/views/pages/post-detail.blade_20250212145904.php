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
                                    <h3 class="comment-title">Bình luận ({{ $post->allComments->count() }})</h3>
                                    @include('pages.comment', [
                                        'comments' => $post->comments,
                                        'post_id' => $post->id,
                                        'depth' => 3,
                                    ])
                                </div>

                                @auth
                                    <div class="reply mt-4">
                                        <div class="reply-head comment-form" id="commentFormContainer">
                                            <h2 class="reply-title">Để lại bình luận</h2>
                                            <form class="form comment_form"
                                                action="{{ route('post-comment.store', $post->slug) }}" method="POST">
                                                @csrf
                                                <div class="form-group comment_form_body">
                                                    <label>Tin nhắn của bạn<span>*</span></label>
                                                    <textarea name="comment" id="comment" rows="5" placeholder="Nhập bình luận..." class="form-control"></textarea>
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                                </div>
                                                <div class="form-group button mt-3">
                                                    <button type="submit" class="btn btn-primary">Đăng bình luận</button>
                                                </div>
                                            </form>
                                        </div>
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

                        <!-- Bản tin -->
                        <div class="single-widget newsletter">
                            <h3 class="title">Bản tin</h3>
                            <div class="letter-inner">
                                <h4>Đăng ký nhận tin tức cập nhật mới nhất.</h4>
                                <form action="{{ route('subscribe') }}" method="POST">
                                    @csrf
                                    <div class="form-inner">
                                        <input type="email" name="email" placeholder="Nhập email của bạn"
                                            class="form-control">
                                        <button type="submit" class="btn btn-primary mt-2">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Blog Single -->

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-reply.reply').click(function(e) {
                e.preventDefault();
                $('.btn-reply.reply').show();
                $('.comment_btn.comment').hide();
                $('.comment_btn.reply').show();
                $(this).hide();
                $('.btn-reply.cancel').hide();
                $(this).siblings('.btn-reply.cancel').show();
                var parent_id = $(this).data('id');
                var html = $('#commentForm');
                $(html).find('#parent_id').val(parent_id);
                $('#commentFormContainer').hide();
                $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
            });

            $('.comment-list').on('click', '.btn-reply.cancel', function(e) {
                e.preventDefault();
                $(this).hide();
                $('.btn-reply.reply').show();
                $('.comment_btn.reply').hide();
                $('.comment_btn.comment').show();
                $('#commentFormContainer').show();
                var html = $('#commentForm');
                $(html).find('#parent_id').val('');
                $('#commentFormContainer').append(html);
            });
        });
    </script>
@endpush
