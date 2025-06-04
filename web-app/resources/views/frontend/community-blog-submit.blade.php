@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Submit Community Blog</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('community-blogs.index') }}">Community Blogs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Submit Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- submit-blog-area -->
    <section class="submit-blog-area section-py-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="submit-blog-wrap">
                        <h3 class="title mb-4">Submit Your Blog</h3>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('community-blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="author_name" class="form-label">Author Name</label>
                                <input type="text" class="form-control" id="author_name" name="author_name" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Blog Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Blog Content <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image (Optional)</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Blog</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- submit-blog-area-end -->
@endsection

@section('styles')
    <style>
        .section-py-90 {
            padding: 90px 0;
        }
        .submit-blog-wrap {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control,
        .form-control:focus {
            border-radius: 5px;
            border: 1px solid #ddd;
            box-shadow: none;
        }
        .form-control[readonly] {
            background-color: #f8f9fa;
        }
        textarea.form-control {
            resize: vertical;
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
            .submit-blog-wrap {
                padding: 20px;
            }
            .title {
                font-size: 20px;
            }
            .btn-primary {
                padding: 8px 15px;
                font-size: 13px;
            }
        }
    </style>
@endsection