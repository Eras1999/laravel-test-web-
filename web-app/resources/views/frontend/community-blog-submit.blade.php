@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/ob2.jpg') }}">
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
                        <form action="{{ route('community-blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogSubmitForm">
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
                                <label for="image" class="form-label">Upload Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
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

        /* SweetAlert custom styles */
        .swal-wide {
            width: 600px !important;
        }
        
        @media (max-width: 768px) {
            .swal-wide {
                width: 95% !important;
            }
        }
    </style>
@endsection

@section('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // SweetAlert for success messages
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ff5733'
            });
        @endif

        // SweetAlert for error messages
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ff5733'
            });
        @endif

        // Form submission with SweetAlert confirmation
        document.getElementById('blogSubmitForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if all required fields are filled
            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();
            const image = document.getElementById('image').files[0];
            
            if (!title || !content || !image) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Information',
                    text: 'Please fill in all required fields including uploading an image.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ff5733'
                });
                return;
            }
            
            // Show confirmation dialog
            Swal.fire({
                title: 'Submit Blog Post?',
                html: `
                    <div style="text-align: left; margin: 20px 0;">
                        <p><strong>📝 Your blog post will be:</strong></p>
                        <ul style="text-align: left; margin: 10px 0;">
                            <li>✅ Reviewed by our admin team</li>
                            <li>📋 Checked for quality and guidelines</li>
                            <li>🚀 Published once approved</li>
                        </ul>
                        <p style="margin-top: 15px;"><em>You'll be notified when your blog is live!</em></p>
                    </div>
                `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#ff5733',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Submit for Review!',
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'swal-wide'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show thank you message and then submit
                    Swal.fire({
                        title: 'Thank You! 🎉',
                        html: `
                            <div style="text-align: center; margin: 20px 0;">
                                <p><strong>Your blog post has been submitted successfully!</strong></p>
                                <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; margin: 15px 0;">
                                    <p>📧 <strong>What's Next?</strong></p>
                                    <p>• Our admin team will review your content</p>
                                  <p>• You'll receive an email notification</p>
                                    <p>• Approved blogs go live within 24-48 hours</p>
                                </div>
                                <p style="color: #28a745; font-weight: 600;">Keep creating amazing content! 💪</p>
                            </div>
                        `,
                        icon: 'success',
                        confirmButtonText: 'Got it!',
                        confirmButtonColor: '#ff5733',
                        allowOutsideClick: false,
                        customClass: {
                            popup: 'swal-wide'
                        }
                    }).then(() => {
                        // Submit the form after user acknowledges
                        this.submit();
                    });
                }
            });
        });
    </script>
@endsection