@extends('frontend.layouts.master')

@section('content')
<main class="profile-page">

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

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

    <!-- Rescue Posts Statistics Section -->
    <section class="rescue-stats-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="stats-card">
                        <h2 class="section-title">Rescue Posts Statistics</h2>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <i class="fas fa-chart-pie"></i>
                                <span class="stat-label">Total Posts</span>
                                <span class="stat-value">{{ $rescuePosts->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-check-circle"></i>
                                <span class="stat-label">Rescued</span>
                                <span class="stat-value">{{ $rescuePosts->where('rescued', true)->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- My Rescue Posts Section -->
    <section class="my-rescue-posts-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="blog-card">
                        <h2 class="section-title">My Rescue Posts</h2>
                        <div class="blog-grid">
                            @forelse ($rescuePosts as $post)
                                <div class="blog-item">
                                    <div class="blog-content">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="Rescue Image" class="blog-image">
                                        @else
                                            <div class="blog-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <h5 class="blog-title">Type: {{ $post->animal_type }}</h5>
                                        @if ($post->rescued)
                                            <p class="blog-meta"><strong>Status:</strong> <span class="status-rescued">Rescued</span></p>
                                        @else
                                            <form action="{{ route('rescue-posts.markAsRescued', $post->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning btn-sm mt-2" onclick="return confirm('Are you sure this rescue has been completed?')">Rescued</button>
                                            </form>
                                        @endif
                                        <p class="blog-meta"><strong>Location:</strong> {{ $post->place ?? 'N/A' }}, {{ $post->district }}</p>
                                        <p class="blog-meta"><strong>Date:</strong> {{ $post->created_at->format('d M Y H:i') }}</p>
                                        <p class="blog-excerpt">{{ Str::limit($post->description, 100) }}</p>
                                        <a href="{{ route('rescue-posts.show', $post->id) }}" class="btn btn-primary btn-sm mt-2">View Details</a>
                                    </div>
                                </div>
                            @empty
                                <div class="no-blogs">
                                    <p class="text-muted">You have not uploaded any rescue posts yet.</p>
                                </div>
                            @endforelse
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
                                <a href="{{ route('community-blogs.show', $blog->id) }}?from=profile" class="blog-item-link">
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
                                </a>
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
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'approved')->where(function ($post) {
                                    return $post->approved_at && $post->approved_at >= now()->subDays(7);
                                })->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-times-circle"></i>
                                <span class="stat-label">Rejected</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'rejected')->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-trash-alt"></i>
                                <span class="stat-label">Expired</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'expired')->count() + $user->adoptionPosts->where('status', 'approved')->where(function ($post) {
                                    return $post->approved_at && $post->approved_at < now()->subDays(7);
                                })->count() }}</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-paw"></i>
                                <span class="stat-label">Adopted</span>
                                <span class="stat-value">{{ $user->adoptionPosts->where('status', 'adopted')->count() }}</span>
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
                            @php
                                // Sort posts by creation date in descending order
                                $sortedPosts = $user->adoptionPosts->sortByDesc('created_at');
                            @endphp
                            @forelse ($sortedPosts as $post)
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
                                        @if ($post->status == 'approved' && $post->approved_at && now()->diffInHours($post->approved_at) >= (7 * 24) || $post->status == 'expired')
                                            <p class="blog-meta"><strong>Status:</strong> <span class="status-expired">Expired</span></p>
                                        @else
                                            <p class="blog-meta"><strong>Status:</strong> <span class="status-{{ $post->status }}">{{ ucfirst($post->status) }}</span></p>
                                            @if ($post->status == 'approved' && $post->approved_at && now()->diffInHours($post->approved_at) < (7 * 24))
                                                <p class="blog-meta"><strong>Time Remaining:</strong>
                                                    @php
                                                        $remainingMinutes = now()->diffInMinutes($post->approved_at->addDays(7));
                                                        $days = floor($remainingMinutes / (60 * 24));
                                                        $hours = floor(($remainingMinutes % (60 * 24)) / 60);
                                                        $minutes = $remainingMinutes % 60;
                                                    @endphp
                                                    {{ $days }}d {{ $hours }}h {{ $minutes }}m
                                                </p>
                                            @endif
                                        @endif
                                        <p class="blog-meta"><strong>Location:</strong> {{ $post->city }}, {{ $post->district }}</p>
                                        <p class="blog-meta"><strong>Mobile:</strong> {{ $post->mobile_number }}</p>
                                        <p class="blog-meta"><strong>Category:</strong> {{ ucfirst($post->category) }}</p>
                                        <p class="blog-excerpt" id="excerpt-{{ $post->id }}">{{ Str::limit($post->description, 100) }}</p>
                                        <p class="blog-full-description" id="full-{{ $post->id }}" style="display: none;">{{ $post->description }}</p>
                                        <button class="btn btn-primary btn-sm mt-2 read-more-btn" data-post-id="{{ $post->id }}">Read More</button>
                                        <div class="adoption-actions mt-2">
                                            @if ($post->status == 'approved' && $post->approved_at && now()->diffInHours($post->approved_at) < (7 * 24))
                                                <form action="{{ route('adoption-posts.adopted', $post->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure this pet has been adopted?')">Adopted</button>
                                                </form>
                                            @elseif ($post->status == 'expired' || ($post->status == 'approved' && $post->approved_at && now()->diffInHours($post->approved_at) >= (7 * 24)))
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
    .my-rescue-posts-section .blog-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .my-rescue-posts-section .blog-item:hover {
        transform: translateY(-5px);
    }

    .my-rescue-posts-section .blog-content {
        padding: 15px;
    }

    .my-rescue-posts-section .blog-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .my-rescue-posts-section .blog-placeholder {
        width: 100%;
        height: 150px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px 10px 0 0;
    }

    .my-rescue-posts-section .blog-placeholder i {
        font-size: 2rem;
        color: #ccc;
    }

    .my-rescue-posts-section .blog-title {
        font-size: 1.2rem;
        color: #333;
        margin: 10px 0;
    }

    .my-rescue-posts-section .blog-meta {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 5px;
    }

    .my-rescue-posts-section .blog-excerpt {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.5;
    }

    .my-rescue-posts-section .status-rescued {
        color: #28a745;
        font-weight: bold;
    }

    /* Styles for blog items */
    .my-blogs-section .blog-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .my-blogs-section .blog-item:hover {
        transform: translateY(-5px);
    }

    .my-blogs-section .blog-item-link {
        display: block;
        text-decoration: none;
        color: inherit;
        cursor: pointer;
    }

    .my-blogs-section .blog-content {
        padding: 15px;
    }

    .my-blogs-section .blog-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .my-blogs-section .blog-placeholder {
        width: 100%;
        height: 150px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px 10px 0 0;
    }

    .my-blogs-section .blog-placeholder i {
        font-size: 2rem;
        color: #ccc;
    }

    .my-blogs-section .blog-title {
        font-size: 1.2rem;
        color: #333;
        margin: 10px 0;
    }

    .my-blogs-section .blog-meta {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 5px;
    }

    .my-blogs-section .blog-excerpt {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.5;
    }

    /* Styles for adoption posts */
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

    .my-adoption-posts-section .blog-excerpt,
    .my-adoption-posts-section .blog-full-description {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.5;
    }

    .my-adoption-posts-section .read-more-btn {
        background: #ff5733;
        border: none;
        padding: 8px 15px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        transition: background 0.3s ease;
    }

    .my-adoption-posts-section .read-more-btn:hover {
        background: #e04e2b;
    }

    .my-adoption-posts-section .status-adopted {
        color: #28a745;
        font-weight: bold;
    }

    .my-adoption-posts-section .status-expired {
        color: #6c757d;
        font-weight: bold;
    }

    @media (max-width: 767px) {
        .my-rescue-posts-section .blog-image,
        .my-rescue-posts-section .blog-placeholder,
        .my-blogs-section .blog-image,
        .my-blogs-section .blog-placeholder,
        .my-adoption-posts-section .blog-image,
        .my-adoption-posts-section .blog-placeholder {
            height: 120px;
        }

        .my-rescue-posts-section .blog-title,
        .my-blogs-section .blog-title,
        .my-adoption-posts-section .blog-title {
            font-size: 1.1rem;
        }

        .my-rescue-posts-section .blog-excerpt,
        .my-blogs-section .blog-excerpt,
        .my-adoption-posts-section .blog-excerpt,
        .my-adoption-posts-section .blog-full-description {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .my-rescue-posts-section .blog-title,
        .my-blogs-section .blog-title,
        .my-adoption-posts-section .blog-title {
            font-size: 1rem;
        }

        .my-rescue-posts-section .blog-meta,
        .my-rescue-posts-section .blog-excerpt,
        .my-blogs-section .blog-meta,
        .my-blogs-section .blog-excerpt,
        .my-adoption-posts-section .blog-meta,
        .my-adoption-posts-section .blog-excerpt,
        .my-adoption-posts-section .blog-full-description {
            font-size: 0.8rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const readMoreButtons = document.querySelectorAll('.read-more-btn');

        readMoreButtons.forEach(button => {
            button.addEventListener('click', function () {
                const postId = this.getAttribute('data-post-id');
                const excerpt = document.getElementById(`excerpt-${postId}`);
                const fullDescription = document.getElementById(`full-${postId}`);

                if (excerpt.style.display === 'none') {
                    excerpt.style.display = 'block';
                    fullDescription.style.display = 'none';
                    this.textContent = 'Read More';
                } else {
                    excerpt.style.display = 'none';
                    fullDescription.style.display = 'block';
                    this.textContent = 'Read Less';
                }
            });
        });
    });
</script>
@endsection