@extends('frontend.layouts.master')

@section('content')
<main class="adoption-index-page">
    <section class="adoption-index-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="adoption-card">
                        <h2 class="section-title">Adopt a Pet</h2>

                        <!-- Filtering System -->
                        <div class="filter-section mb-4">
                            <form id="filter-form" method="GET" action="{{ route('adoption-posts.index') }}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="district" class="form-label">Filter by District</label>
                                        <select name="district" id="district" class="form-select">
                                            <option value="">All Districts</option>
                                            @foreach ($posts->pluck('district')->unique() as $district)
                                                <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="category" class="form-label">Filter by Category</label>
                                        <select name="category" id="category" class="form-select">
                                            <option value="">All Categories</option>
                                            <option value="dog" {{ request('category') == 'dog' ? 'selected' : '' }}>Dog</option>
                                            <option value="cat" {{ request('category') == 'cat' ? 'selected' : '' }}>Cat</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('adoption-posts.index') }}" class="btn btn-secondary">Reset Filters</a>
                            </form>
                        </div>

                        <!-- Adoption Posts -->
                        <div class="adoption-grid">
                            @forelse ($posts as $post)
                                <div class="adoption-item">
                                    <div class="adoption-image-container">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="adoption-image">
                                        @else
                                            <div class="adoption-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="adoption-content">
                                        <h5 class="adoption-title">{{ $post->title }}</h5>
                                        <div class="adoption-meta mb-2">
                                            <span class="badge bg-primary">{{ ucfirst($post->category) }}</span>
                                            @if ($post->status == 'approved' && now()->diffInHours($post->approved_at) < 24)
                                                <span class="badge bg-success">
                                                    @php
                                                        $remainingMinutes = now()->diffInMinutes($post->approved_at->addHours(24));
                                                        $hours = floor($remainingMinutes / 60);
                                                        $minutes = $remainingMinutes % 60;
                                                    @endphp
                                                    Time Left: {{ $hours }}h {{ $minutes }}m
                                                </span>
                                            @endif
                                        </div>
                                        <p class="adoption-meta"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $post->nearby_city }}, {{ $post->city }}, {{ $post->district }}</p>
                                        <p class="adoption-meta"><i class="fas fa-phone"></i> <strong>Contact:</strong> {{ $post->mobile_number }}</p>
                                        <p class="adoption-meta"><i class="fas fa-user"></i> <strong>Posted by:</strong> {{ $post->author_name }}</p>
                                        <p class="adoption-description"><strong>Description:</strong> {{ $post->description }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="no-posts">
                                    <p class="text-muted">No adoption posts available at the moment.</p>
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
<style>
    .adoption-index-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Poppins', sans-serif;
        padding: 40px 0;
        min-height: 100vh;
    }

    .adoption-index-section {
        width: 100%;
    }

    .adoption-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .adoption-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-size: 2rem;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 30px;
        text-align: center;
    }

    .filter-section {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .filter-section .form-label {
        font-weight: 600;
        color: #333;
    }

    .filter-section .form-select {
        border-radius: 8px;
        padding: 8px;
    }

    .filter-section .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
    }

    .filter-section .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        margin-left: 10px;
    }

    .adoption-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .adoption-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .adoption-item:hover {
        transform: translateY(-5px);
    }

    .adoption-image-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .adoption-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .adoption-placeholder {
        width: 100%;
        height: 200px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px 10px 0 0;
    }

    .adoption-placeholder i {
        font-size: 2.5rem;
        color: #ccc;
    }

    .adoption-content {
        padding: 20px;
        flex-grow: 1;
    }

    .adoption-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }

    .adoption-meta {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .adoption-meta i {
        margin-right: 8px;
        color: #007bff;
    }

    .adoption-description {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
        margin-top: 10px;
    }

    .adoption-meta .badge {
        margin-right: 5px;
        font-size: 0.85rem;
    }

    .no-posts {
        grid-column: 1 / -1;
        text-align: center;
        padding: 20px;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 1.8rem;
        }

        .col-lg-10 {
            flex: 0 0 90%;
            max-width: 90%;
        }

        .adoption-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }

    @media (max-width: 767px) {
        .adoption-index-section {
            padding: 30px 15px;
        }

        .adoption-card {
            padding: 20px;
        }

        .section-title {
            font-size: 1.6rem;
        }

        .adoption-image-container, .adoption-placeholder {
            height: 150px;
        }

        .adoption-title {
            font-size: 1.3rem;
        }

        .adoption-description {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.4rem;
        }

        .adoption-grid {
            grid-template-columns: 1fr;
        }

        .adoption-title {
            font-size: 1.2rem;
        }

        .adoption-meta, .adoption-description {
            font-size: 0.85rem;
        }
    }
</style>
@endsection