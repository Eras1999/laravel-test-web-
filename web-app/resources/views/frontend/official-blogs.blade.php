@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Official Blogs</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Official Blogs</li>
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
            <div class="row justify-content-center">
                @forelse ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="blog-post-item h-100 d-flex flex-column">
                            <div class="blog-post-thumb">
                                <a href="{{ route('official-blogs.show', $blog->id) }}">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                                </a>
                            </div>
                            <div class="blog-post-content flex-grow-1 d-flex flex-column">
                                <div class="blog-meta">
                                    <ul>
                                        <li><i class="far fa-calendar-alt"></i> {{ $blog->date->format('M d, Y') }}</li>
                                    </ul>
                                </div>
                                <h3 class="title"><a href="{{ route('official-blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                <p>{{ Str::limit($blog->content, 100) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('official-blogs.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No official blogs available at the moment.</p>
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
        .blog-post-item {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .blog-post-item:hover {
            transform: translateY(-10px);
        }
        .blog-post-thumb img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .blog-post-content {
            padding: 20px;
        }
        .blog-meta ul {
            list-style: none;
            padding: 0;
            margin-bottom: 10px;
        }
        .blog-meta ul li {
            display: inline-block;
            font-size: 14px;
            color: #666;
        }
        .blog-meta ul li i {
            margin-right: 5px;
            color: #ff5733;
        }
        .blog-post-content .title {
            font-size: 20px;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        .blog-post-content .title a {
            color: #333;
            text-decoration: none;
        }
        .blog-post-content .title a:hover {
            color: #ff5733;
        }
        .blog-post-content p {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .blog-post-content .btn {
            background: #ff5733;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }
        .blog-post-content .btn:hover {
            background: #e04e2b;
        }
        .pagination-wrap .pagination {
            justify-content: center;
        }
        .pagination-wrap .page-link {
            color: #ff5733;
            border: none;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .pagination-wrap .page-item.active .page-link {
            background: #ff5733;
            color: #fff;
        }
        .pagination-wrap .page-link:hover {
            background: #ff5733;
            color: #fff;
        }

        @media (max-width: 767px) {
            .blog-post-thumb img {
                height: 180px;
            }
            .blog-post-content .title {
                font-size: 18px;
            }
            .blog-post-content p {
                font-size: 14px;
            }
            .section-py-90 {
                padding: 60px 0;
            }
        }
        @media (max-width: 576px) {
            .blog-post-thumb img {
                height: 160px;
            }
            .blog-post-content .title {
                font-size: 16px;
            }
            .blog-post-content p {
                font-size: 13px;
            }
            .blog-post-content .btn {
                padding: 8px 15px;
                font-size: 13px;
            }
        }
    </style>
@endsection