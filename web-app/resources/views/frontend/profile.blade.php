@extends('frontend.layouts.master')

@section('content')
<main class="profile-page">
    <!-- User Profile Section -->
    <section class="profile-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="profile-card">
                        <div class="profile-header">
                            <h1 class="profile-title">My Profile</h1>
                            <p class="profile-subtitle">Welcome, {{ $user->name }}!</p>
                        </div>
                        <div class="profile-content">
                            <div class="profile-details">
                                <div class="detail-item">
                                    <i class="fas fa-user"></i>
                                    <span class="detail-label">Full Name:</span>
                                    <span class="detail-value">{{ $user->name }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-envelope"></i>
                                    <span class="detail-label">Email Address:</span>
                                    <span class="detail-value">{{ $user->email }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar"></i>
                                    <span class="detail-label">Joined:</span>
                                    <span class="detail-value">{{ $user->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="profile-actions">
                                <a href="{{ route('logout') }}" class="btn logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Statistics Section -->
    <section class="blog-stats-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="stats-card">
                        <h2 class="section-title">Blog Statistics</h2>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <i class="fas fa-chart-pie"></i>
                                <span class="stat-label">Total Blogs</span>
                                <span class="stat-value">{{ $user->blogs->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-hourglass-half"></i>
                                <span class="stat-label">Pending</span>
                                <span class="stat-value">{{ $user->blogs->where('status', 'pending')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-check-circle"></i>
                                <span class="stat-label">Approved</span>
                                <span class="stat-value">{{ $user->blogs->where('status', 'approved')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-times-circle"></i>
                                <span class="stat-label">Rejected</span>
                                <span class="stat-value">{{ $user->blogs->where('status', 'rejected')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-trash-alt"></i>
                                <span class="stat-label">Deleted</span>
                                <span class="stat-value">{{ $user->blogs->where('status', 'deleted')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- My Blogs Section -->
    <section class="my-blogs-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="blog-card">
                        <h2 class="section-title">My Blogs</h2>
                        <div class="blog-grid">
                            @forelse ($user->blogs as $blog)
                                <div class="blog-item">
                                    <div class="blog-content">
                                        @if ($blog->image)
                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-image">
                                        @else
                                            <div class="blog-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <h5 class="blog-title">{{ $blog->title }}</h5>
                                        <p class="blog-meta"><strong>Status:</strong> <span class="status-{{ $blog->status }}">{{ ucfirst($blog->status) }}</span></p>
                                        <p class="blog-meta"><strong>Date:</strong> {{ $blog->date }}</p>
                                        <p class="blog-excerpt">{{ Str::limit($blog->content, 100) }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="no-blogs">
                                    <p class="text-muted">You have not uploaded any blogs yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Adoption Posts Statistics Section -->
    <section class="adoption-stats-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="stats-card">
                        <h2 class="section-title">Adoption Posts Statistics</h2>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <i class="fas fa-chart-pie"></i>
                                <span class="stat-label">Total Posts</span>
                                <span class="stat-value">{{ $user->adoptionPosts->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-hourglass-half"></i>
                                <span class="stat-label">Pending</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'pending')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-check-circle"></i>
                                <span class="stat-label">Approved</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'approved')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-times-circle"></i>
                                <span class="stat-label">Rejected</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'rejected')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-trash-alt"></i>
                                <span class="stat-label">Expired</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'expired')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-paw"></i>
                                <span class="stat-label">Adopted</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'rejected')->where('approved_at', '<', now()->subHours(24))->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- My Adoption Posts Section -->
    <section class="my-adoption-posts-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="blog-card">
                        <h2 class="section-title">My Adoption Posts</h2>
                        <div class="blog-grid">
                            @forelse ($user->adoptionPosts as $post)
                                <div class="blog-item">
                                    <div class="blog-content">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="blog-image">
                                        @else
                                            <div class="blog-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <h5 class="blog-title">{{ $post->title }}</h5>
                                        <p class="blog-meta"><strong>Status:</strong> <span class="status-{{ $post->status }}">{{ ucfirst($post->status) }}</span></p>
                                        <p class="blog-meta"><strong>Location:</strong> {{ $post->city }}, {{ $post->district }}</p>
                                        <p class="blog-meta"><strong>Mobile:</strong> {{ $post->mobile_number }}</p>
                                        @if ($post->status == 'approved' && now()->diffInHours($post->approved_at) < 24)
                                            <p class="blog-meta"><strong>Time Remaining:</strong>
                                                @php
                                                    $remainingMinutes = now()->diffInMinutes($post->approved_at->addHours(24));
                                                    $hours = floor($remainingMinutes / 60);
                                                    $minutes = $remainingMinutes % 60;
                                                @endphp
                                                {{ $hours }}h {{ $minutes }}m
                                            </p>
                                        @endif
                                        <p class="blog-excerpt">{{ Str::limit($post->description, 100) }}</p>
                                        <div class="adoption-actions mt-2">
                                            @if ($post->status == 'approved' && now()->diffInHours($post->approved_at) < 24)
                                                <form action="{{ route('adoption-posts.adopted', $post->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure this pet has been adopted?')">Adopted</button>
                                                </form>
                                            @endif
                                            @if ($post->status == 'expired')
                                                <form action="{{ route('adoption-posts.repost', $post->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to repost this?')">Repost</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="no-blogs">
                                    <p class="text-muted">You have not uploaded any adoption posts yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
<style>
    .my-adoption-posts-section .blog-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .my-adoption-posts-section .blog-item:hover {
        transform: translateY(-5px);
    }

    .my-adoption-posts-section .blog-content {
        padding: 15px;
    }

    .my-adoption-posts-section .blog-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .my-adoption-posts-section .blog-placeholder {
        width: 100%;
        height: 150px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px 10px 0 0;
    }

    .my-adoption-posts-section .blog-placeholder i {
        font-size: 2rem;
        color: #ccc;
    }

    .my-adoption-posts-section .blog-title {
        font-size: 1.2rem;
        color: #333;
        margin: 10px 0;
    }

    .my-adoption-posts-section .blog-meta {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 5px;
    }

    .my-adoption-posts-section .blog-excerpt {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.5;
    }

    @media (max-width: 767px) {
        .my-adoption-posts-section .blog-image, .my-adoption-posts-section .blog-placeholder {
            height: 120px;
        }

        .my-adoption-posts-section .blog-title {
            font-size: 1.1rem;
        }

        .my-adoption-posts-section .blog-excerpt {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .my-adoption-posts-section .blog-title {
            font-size: 1rem;
        }

        .my-adoption-posts-section .blog-meta, .my-adoption-posts-section .blog-excerpt {
            font-size: 0.8rem;
        }
    }
</style>
@endsection