@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">{{ $blog->title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('official-blogs.index') }}">Official Blogs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 20) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- blog-details-area -->
    <section class="blog-details-area section-py-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-details-wrap">
                        <div class="blog-details-thumb">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                        </div>
                        <div class="blog-details-content">
                            <div class="blog-meta">
                                <ul>
                                    <li><i class="far fa-calendar-alt"></i> {{ $blog->date->format('M d, Y') }}</li>
                                </ul>
                            </div>
                            <h2 class="title">{{ $blog->title }}</h2>
                            <p>{{ $blog->content }}</p>
                            <div class="mt-4">
                                <a href="{{ route('official-blogs.index') }}" class="btn btn-primary">Back to Blogs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-details-area-end -->
@endsection

@section('styles')
    <style>
        .section-py-90 {
            padding: 90px 0;
        }
        .blog-details-wrap {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .blog-details-thumb img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .blog-details-content {
            padding: 30px;
        }
        .blog-meta ul {
            list-style: none;
            padding: 0;
            margin-bottom: 15px;
        }
        .blog-meta ul li {
            display: inline-block;
            font-size: 15px;
            color: #666;
        }
        .blog-meta ul li i {
            margin-right: 5px;
            color: #ff5733;
        }
        .blog-details-content .title {
            font-size: 28px;
            margin-bottom: 20px;
            line-height: 1.3;
            color: #333;
        }
        .blog-details-content p {
            font-size: 16px;
            line-height: 1.8;
            color: #666;
        }
        .blog-details-content .btn {
            background: #ff5733;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }
        .blog-details-content .btn:hover {
            background: #e04e2b;
        }

        @media (max-width: 767px) {
            .blog-details-thumb img {
                height: 300px;
            }
            .blog-details-content {
                padding: 20px;
            }
            .blog-details-content .title {
                font-size: 24px;
            }
            .blog-details-content p {
                font-size: 15px;
            }
            .section-py-90 {
                padding: 60px 0;
            }
        }
        @media (max-width: 576px) {
            .blog-details-thumb img {
                height: 250px;
            }
            .blog-details-content .title {
                font-size: 20px;
            }
            .blog-details-content p {
                font-size: 14px;
            }
            .blog-details-content .btn {
                padding: 8px 15px;
                font-size: 13px;
            }
        }
    </style>
@endsection