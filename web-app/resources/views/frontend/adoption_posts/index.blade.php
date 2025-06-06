@extends('frontend.layouts.master')

@section('content')
<main class="adoption-index-page">
    <section class="adoption-index-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="adoption-card">
                        <h2 class="section-title">Adopt a Pet</h2>
                        <div class="adoption-grid">
                            @forelse ($posts as $post)
                                <div class="adoption-item">
                                    <div class="adoption-content">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="adoption-image">
                                        @else
                                            <div class="adoption-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <h5 class="adoption-title">{{ $post->title }}</h5>
                                        <p class="adoption-meta"><strong>Category:</strong> {{ ucfirst($post->category) }}</p>
                                        <p class="adoption-meta"><strong>Location:</strong> {{ $post->nearby_city }}, {{ $post->city }}, {{ $post->district }}</p>
                                        <p class="adoption-meta"><strong>Mobile:</strong> {{ $post->mobile_number }}</p>
                                        <p class="adoption-meta"><strong>Posted by:</strong> {{ $post->author_name }}</p>
                                        @if ($post->status == 'approved' && now()->diffInHours($post->approved_at) < 24)
                                            <p class="adoption-meta"><strong>Time Remaining:</strong>
                                                @php
                                                    $remainingMinutes = now()->diffInMinutes($post->approved_at->addHours(24));
                                                    $hours = floor($remainingMinutes / 60);
                                                    $minutes = $remainingMinutes % 60;
                                                @endphp
                                                {{ $hours }}h {{ $minutes }}m
                                            </p>
                                        @endif
                                        <p class="adoption-excerpt">{{ Str::limit($post->description, 100) }}</p>
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

    .adoption-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .adoption-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .adoption-item:hover {
        transform: translateY(-5px);
    }

    .adoption-content {
        padding: 15px;
    }

    .adoption-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .adoption-placeholder {
        width: 100%;
        height: 150px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px 10px 0 0;
    }

    .adoption-placeholder i {
        font-size: 2rem;
        color: #ccc;
    }

    .adoption-title {
        font-size: 1.2rem;
        color: #333;
        margin: 10px 0;
    }

    .adoption-meta {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 5px;
    }

    .adoption-excerpt {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.5;
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

        .adoption-image, .adoption-placeholder {
            height: 120px;
        }

        .adoption-title {
            font-size: 1.1rem;
        }

        .adoption-excerpt {
            font-size: 0.85rem;
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
            font-size: 1rem;
        }

        .adoption-meta, .adoption-excerpt {
            font-size: 0.8rem;
        }
    }
</style>
@endsection