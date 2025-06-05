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
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/profile.css') }}">
@endsection