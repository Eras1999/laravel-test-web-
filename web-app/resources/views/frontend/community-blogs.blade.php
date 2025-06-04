@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/breadcrumb_bg.jpg') }}">
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
                <div class="col-auto">
                    <a href="{{ route('community-blogs.submit') }}" class="btn btn-primary">Add Blog</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <p class="text-muted">No community blogs available yet. Be the first to add one!</p>
                </div>
            </div>
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
        .btn-primary {
            background: #ff5733;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #e04e2b;
        }

        @media (max-width: 767px) {
            .section-py-90 {
                padding: 60px 0;
            }
            .section-title {
                font-size: 20px;
            }
            .btn-primary {
                padding: 8px 15px;
                font-size: 13px;
            }
        }
    </style>
@endsection