@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4 mb-0">Admin Dashboard</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm" onclick="refreshDashboard()">
                <i class="fas fa-sync-alt me-2"></i>Refresh
            </button>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="card mb-4 border-0 shadow-lg bg-gradient-primary text-white">
        <div class="card-body">
            <h5><i class="fas fa-tachometer-alt me-2"></i>Welcome to the Admin Panel</h5>
            <p class="mb-0">Monitor and manage all key sections of your application. View counts and navigate to each section below.</p>
        </div>
    </div>

    <!-- Key Metrics Row -->
    <div class="row mb-4">
        <!-- Total Users -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-users me-2"></i>Total Users</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalUsers)
                            {{ $totalUsers }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('user_credentials.index') }}" class="small text-primary stretched-link">View Users</a>
                </div>
            </div>
        </div>

        <!-- Sliders -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-images me-2"></i>Sliders</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalSliders)
                            {{ $totalSliders }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('slider.index') }}" class="small text-primary stretched-link">View Sliders</a>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-quote-left me-2"></i>Testimonials</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalTestimonials)
                            {{ $totalTestimonials }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('Testimonial.index') }}" class="small text-primary stretched-link">View Testimonials</a>
                </div>
            </div>
        </div>

        <!-- News -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-newspaper me-2"></i>News</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalNews)
                            {{ $totalNews }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('news.index') }}" class="small text-primary stretched-link">View News</a>
                </div>
            </div>
        </div>

        <!-- Contact Submissions -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-envelope me-2"></i>Contact Submissions</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalContacts)
                            {{ $totalContacts }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('contact.index') }}" class="small text-primary stretched-link">View Contacts</a>
                </div>
            </div>
        </div>

        <!-- Official Blogs -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-blog me-2"></i>Official Blogs</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalOfficialBlogs)
                            {{ $totalOfficialBlogs }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('official_blogs.index') }}" class="small text-primary stretched-link">View Official Blogs</a>
                </div>
            </div>
        </div>

        <!-- Community Blogs -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-users-cog me-2"></i>Community Blogs</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalCommunityBlogs)
                            {{ $totalCommunityBlogs }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('admin.community-blogs.index') }}" class="small text-primary stretched-link">View Community Blogs</a>
                </div>
            </div>
        </div>

        <!-- Adoption Posts -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-paw me-2"></i>Adoption Posts</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalAdoptionPosts)
                            {{ $totalAdoptionPosts }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('admin.adoption-posts.index') }}" class="small text-primary stretched-link">View Adoption Posts</a>
                </div>
            </div>
        </div>

        <!-- Snake Catchers -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-user-shield me-2"></i>Snake Catchers</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalSnakeCatchers)
                            {{ $totalSnakeCatchers }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('admin.snake-catchers.index') }}" class="small text-primary stretched-link">View Snake Catchers</a>
                </div>
            </div>
        </div>

        <!-- Rescue Posts -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h6 class="text-muted"><i class="fas fa-ambulance me-2"></i>Rescue Posts</h6>
                    <h3 class="text-primary fw-bold">
                        @isset($totalRescuePosts)
                            {{ $totalRescuePosts }}
                        @else
                            <span class="text-secondary">—</span>
                        @endisset
                    </h3>
                    <a href="{{ route('admin.rescue-posts.index') }}" class="small text-primary stretched-link">View Rescue Posts</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Cards -->
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4 border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>User Management</h5>
                </div>
                <div class="card-body">
                    <p>Manage user accounts, credentials, and permissions. View or export user data.</p>
                    <a href="{{ route('user_credentials.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-right me-2"></i>Go to User Management
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4 border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Content Management</h5>
                </div>
                <div class="card-body">
                    <p>Manage sliders, testimonials, and news content.</p>
                    <div class="btn-group">
                        <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-images me-2"></i>Sliders
                        </a>
                        <a href="{{ route('Testimonial.index') }}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-quote-left me-2"></i>Testimonials
                        </a>
                        <a href="{{ route('news.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-newspaper me-2"></i>News
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4 border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-paw me-2"></i>Animal Welfare</h5>
                </div>
                <div class="card-body">
                    <p>Manage adoption posts, rescue posts, and snake catcher registrations.</p>
                    <div class="btn-group">
                        <a href="{{ route('admin.adoption-posts.index') }}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-paw me-2"></i>Adoption Posts
                        </a>
                        <a href="{{ route('admin.rescue-posts.index') }}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-ambulance me-2"></i>Rescue Posts
                        </a>
                        <a href="{{ route('admin.snake-catchers.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-shield me-2"></i>Snake Catchers
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4 border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-blog me-2"></i>Blog Management</h5>
                </div>
                <div class="card-body">
                    <p>Manage official and community blogs.</p>
                    <div class="btn-group">
                        <a href="{{ route('official_blogs.index') }}" class="btn btn-primary btn-sm me-2">
                            <i class="fas fa-blog me-2"></i>Official Blogs
                        </a>
                        <a href="{{ route('admin.community-blogs.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-users-cog me-2"></i>Community Blogs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
    .card-header {
        border-bottom: none;
    }
    .card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3 0%, #003087 100%);
    }
    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
        }
        .btn-group .btn {
            margin: 2px 0;
        }
        h1.mt-4 {
            font-size: 1.5rem;
        }
        h3.fw-bold {
            font-size: 1.25rem;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function refreshDashboard() {
        Swal.fire({
            title: 'Refreshing Dashboard...',
            text: 'Please wait while we update the data.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        setTimeout(() => {
            window.location.reload();
            Swal.fire({
                icon: 'success',
                title: 'Dashboard Refreshed!',
                text: 'The dashboard has been updated.',
                confirmButtonColor: '#007bff',
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }, 1000);
    }
</script>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
@endsection
