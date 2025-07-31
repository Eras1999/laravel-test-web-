@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/cb1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Community Blogs</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Community Blogs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- blog-area -->
    <section class="blog-area section-py-90">
        <div class="container">
            <div class="row justify-content-between align-items-center mb-4">
                <div class="col-auto">
                    <h3 class="section-title">Community Blogs</h3>
                </div>
                @if(auth('frontend')->check())
                    <div class="col-auto">
                        <a href="{{ route('community-blogs.submit') }}" class="btn btn-primary">Add Blog</a>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center">
                @forelse ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="blog-post-item">
                            <div class="blog-post-thumb">
                                <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('frontend/img/placeholder.jpg') }}" alt="{{ $blog->title }}" class="img-fluid">
                            </div>
                            <div class="blog-post-content">
                                <h4 class="title"><a href="{{ route('community-blogs.show', $blog->id) }}">{{ $blog->title }}</a></h4>
                                <p class="text-truncate">{{ Str::limit($blog->content, 100) }}</p>
                                <a href="{{ route('community-blogs.show', $blog->id) }}" class="read-more">Read More <img src="{{ asset('frontend/img/icon/pawprint.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No community blogs available yet. Be the first to add one!</p>
                    </div>
                @endforelse
            </div>
            <!-- Pagination -->
            @if ($blogs->hasPages())
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrap mt-5">
                            {{ $blogs->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- blog-area-end -->
@endsection

@section('styles')
    <style>
        .section-py-90 {
            padding: 90px 0;
        }
        .section-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 0;
        }
        .blog-post-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .blog-post-item:hover {
            transform: translateY(-5px);
        }
        .blog-post-thumb img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .blog-post-content {
            padding: 15px;
        }
        .title a {
            color: #333;
            font-size: 18px;
            text-decoration: none;
        }
        .title a:hover {
            color: #46ac0b;
        }
        .read-more {
            color: #46ac0b;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .read-more img {
            margin-left: 5px;
            width: 15px;
        }
        .btn-primary {
            background: #46ac0b;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #46ac0b;
        }
        .pagination-wrap .pagination {
            justify-content: center;
        }
        .pagination-wrap .page-link {
            color: #46ac0b;
            border: none;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .pagination-wrap .page-item.active .page-link {
            background: #46ac0b;
            color: #fff;
        }
        .pagination-wrap .page-link:hover {
            background: #46ac0b;
            color: #fff;
        }

        @media (max-width: 767px) {
            .section-py-90 {
                padding: 60px 0;
            }
            .section-title {
                font-size: 20px;
            }
            .blog-post-thumb img {
                height: 150px;
            }
            .title a {
                font-size: 16px;
            }
            .btn-primary {
                padding: 8px 15px;
                font-size: 13px;
            }
        }
    </style>
@endsection