@extends('frontend.layouts.master')

@section('content')
<main class="adoption-index-page">
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/about1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Adopt a Pet</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Adopt a Pet</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <section class="adoption-index-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="adoption-card">
                        <h2 class="section-title">Find Your Perfect Companion</h2>

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
                                <div class="filter-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                        Apply Filters
                                    </button>
                                    <a href="{{ route('adoption-posts.index') }}" class="btn btn-outline">
                                        <i class="fas fa-refresh"></i>
                                        Reset
                                    </a>
                                </div>
                            </form>
                        </div>

                        <!-- Adoption Posts -->
                        <div class="adoption-grid">
                            @forelse ($posts as $post)
                                <div class="adoption-item">
                                    <div class="adoption-image-container" onclick="openImageModal('{{ $post->image ? asset('storage/' . $post->image) : '' }}', '{{ $post->title }}')">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="adoption-image">
                                            <div class="image-zoom-hint">
                                                <i class="fas fa-search-plus"></i>
                                            </div>
                                        @else
                                            <div class="adoption-placeholder">
                                                <i class="fas fa-paw"></i>
                                            </div>
                                        @endif
                                        <div class="adoption-overlay">
                                            <div class="adoption-badges">
                                                <span class="badge category-badge">{{ ucfirst($post->category) }}</span>
                                                @if ($post->status == 'approved' && now()->diffInHours($post->approved_at) < (7 * 24))
                                                    <span class="badge time-badge">
                                                        @php
                                                            $remainingMinutes = now()->diffInMinutes($post->approved_at->addDays(7));
                                                            $days = floor($remainingMinutes / (60 * 24));
                                                            $hours = floor(($remainingMinutes % (60 * 24)) / 60);
                                                            $minutes = $remainingMinutes % 60;
                                                        @endphp
                                                        {{ $days }}d {{ $hours }}h left
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adoption-content">
                                        <h5 class="adoption-title">{{ $post->title }}</h5>
                                        
                                        <div class="adoption-details">
                                            <div class="detail-item">
                                                <div class="detail-icon">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                                <div class="detail-text">
                                                    <span class="detail-label">Location</span>
                                                    <span class="detail-value">{{ $post->nearby_city }}, {{ $post->city }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="detail-item">
                                                <div class="detail-icon">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                                <div class="detail-text">
                                                    <span class="detail-label">Contact</span>
                                                    <span class="detail-value">{{ $post->mobile_number }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="detail-item">
                                                <div class="detail-icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="detail-text">
                                                    <span class="detail-label">Posted by</span>
                                                    <span class="detail-value">{{ $post->author_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="adoption-description">
                                            <p>{{ $post->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="no-posts">
                                    <div class="no-posts-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h3>No pets found</h3>
                                    <p>Try adjusting your filters to see more adoption posts.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if($posts->hasPages())
                            <div class="pagination-wrapper">
                                <div class="pagination-info">
                                    <span class="pagination-text">
                                        Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
                                    </span>
                                </div>
                                
                                <nav class="pagination-nav" aria-label="Pagination Navigation">
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($posts->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                            @if ($page == $posts->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($posts->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeImageModal()">&times;</span>
            <img id="modalImage" src="" alt="">
            <div class="modal-caption">
                <h4 id="modalTitle"></h4>
            </div>
        </div>
    </div>
</main>
@endsection

@section('styles')
<style>
    .adoption-index-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        padding: 60px 0;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    .adoption-index-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="0.5" fill="rgba(255,255,255,0.03)"/><circle cx="50" cy="10" r="0.8" fill="rgba(255,255,255,0.04)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
        z-index: 0;
    }

    .adoption-index-section {
        position: relative;
        z-index: 1;
    }

    .adoption-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        box-shadow: 
            0 32px 64px rgba(0, 0, 0, 0.12),
            0 0 0 1px rgba(255, 255, 255, 0.05);
        padding: 48px;
        backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .adoption-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
        background-size: 300% 100%;
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .section-title {
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-align: center;
        margin-bottom: 48px;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .filter-section {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 40px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 
            0 8px 32px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }

    .filter-section .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .filter-section .form-select {
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .filter-section .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 0.95);
    }

    .filter-actions {
        display: flex;
        gap: 16px;
        margin-top: 24px;
        flex-wrap: wrap;
    }

    .filter-section .btn {
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .filter-section .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
    }

    .filter-section .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.5);
    }

    .filter-section .btn-outline {
        background: rgba(255, 255, 255, 0.8);
        color: #667eea;
        border: 2px solid rgba(102, 126, 234, 0.2);
        backdrop-filter: blur(10px);
    }

    .filter-section .btn-outline:hover {
        background: rgba(102, 126, 234, 0.1);
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-1px);
    }

    .adoption-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 32px;
    }

    .adoption-item {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        position: relative;
    }

    .adoption-item:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    .adoption-image-container {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
        cursor: pointer;
    }

    .image-zoom-hint {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        z-index: 2;
    }

    .adoption-image-container:hover .image-zoom-hint {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.1);
    }

    .adoption-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .adoption-item:hover .adoption-image {
        transform: scale(1.1);
    }

    .adoption-placeholder {
        width: 100%;
        height: 280px;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .adoption-placeholder i {
        font-size: 4rem;
        color: #cbd5e1;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }

    .adoption-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.6) 0%, transparent 40%, transparent 60%, rgba(0,0,0,0.4) 100%);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .adoption-item:hover .adoption-overlay {
        opacity: 1;
    }

    .adoption-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .adoption-badges .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .category-badge {
        background: rgba(102, 126, 234, 0.9);
        color: white;
    }

    .time-badge {
        background: rgba(16, 185, 129, 0.9);
        color: white;
    }

    .adoption-content {
        padding: 32px;
    }

    .adoption-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 24px;
        line-height: 1.3;
    }

    .adoption-details {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 24px;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .detail-icon i {
        color: #667eea;
        font-size: 1rem;
    }

    .detail-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .detail-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .detail-value {
        font-size: 0.95rem;
        color: #374151;
        font-weight: 500;
    }

    .adoption-description {
        background: rgba(102, 126, 234, 0.05);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
        border-left: 4px solid #667eea;
    }

    .adoption-description p {
        color: #4b5563;
        line-height: 1.6;
        margin: 0;
        font-size: 0.95rem;
    }

    /* Image Modal Styles */
    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(10px);
        animation: fadeIn 0.3s ease-out;
    }

    .image-modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: modalSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-close {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 20px;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(245, 87, 108, 0.4);
        transition: all 0.3s ease;
        z-index: 10001;
    }

    .modal-close:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 8px 24px rgba(245, 87, 108, 0.6);
    }

    #modalImage {
        width: 100%;
        height: auto;
        max-height: 70vh;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .modal-caption {
        margin-top: 20px;
        text-align: center;
    }

    .modal-caption h4 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes modalSlideIn {
        from { 
            opacity: 0;
            transform: scale(0.8) translateY(20px);
        }
        to { 
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Modal Responsive Design */
    @media (max-width: 768px) {
        .modal-content {
            margin: 10px;
            padding: 15px;
            max-width: 95vw;
            max-height: 95vh;
        }

        #modalImage {
            max-height: 60vh;
        }

        .modal-caption h4 {
            font-size: 1.2rem;
        }

        .modal-close {
            width: 35px;
            height: 35px;
            font-size: 18px;
        }
    }

    /* Pagination Styles */
    .pagination-wrapper {
        margin-top: 60px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 24px;
    }

    .pagination-info {
        text-align: center;
    }

    .pagination-text {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
        background: rgba(255, 255, 255, 0.8);
        padding: 8px 16px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .pagination-nav {
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .page-item {
        display: flex;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 48px;
        height: 48px;
        padding: 0 16px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 16px;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .page-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .page-link:hover::before {
        left: 100%;
    }

    .page-link:hover {
        transform: translateY(-2px) scale(1.05);
        border-color: #667eea;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.2);
        background: rgba(255, 255, 255, 0.95);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        box-shadow: 
            0 8px 24px rgba(102, 126, 234, 0.4),
            0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .page-item.active .page-link:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 
            0 12px 32px rgba(102, 126, 234, 0.5),
            0 0 0 3px rgba(102, 126, 234, 0.15);
    }

    .page-item.disabled .page-link {
        background: rgba(255, 255, 255, 0.5);
        color: #d1d5db;
        border-color: rgba(209, 213, 219, 0.3);
        cursor: not-allowed;
        box-shadow: none;
    }

    .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
    }

    .page-link i {
        font-size: 0.9rem;
    }

    /* Pagination Animation */
    @keyframes pageSlideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .pagination-wrapper {
        animation: pageSlideIn 0.6s ease-out;
    }

    /* Pagination Responsive Design */
    @media (max-width: 768px) {
        .pagination-wrapper {
            margin-top: 40px;
            gap: 16px;
        }

        .pagination {
            gap: 6px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-link {
            min-width: 44px;
            height: 44px;
            padding: 0 12px;
            font-size: 0.9rem;
            border-radius: 14px;
        }

        .pagination-text {
            font-size: 0.85rem;
            padding: 6px 12px;
        }
    }

    @media (max-width: 480px) {
        .pagination {
            gap: 4px;
        }

        .page-link {
            min-width: 40px;
            height: 40px;
            padding: 0 10px;
            font-size: 0.85rem;
            border-radius: 12px;
        }

        .pagination-text {
            font-size: 0.8rem;
        }

        /* Hide some page numbers on very small screens */
        .page-item:not(.active):not(:first-child):not(:last-child):not(:nth-child(2)):not(:nth-last-child(2)) {
            display: none;
        }
    }

    @media (max-width: 480px) {
        .modal-content {
            margin: 5px;
            padding: 10px;
        }

        #modalImage {
            max-height: 50vh;
        }

        .modal-caption h4 {
            font-size: 1.1rem;
        }
    }

    .no-posts {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 40px;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 24px;
        backdrop-filter: blur(10px);
    }

    .no-posts-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }

    .no-posts-icon i {
        font-size: 2rem;
        color: #667eea;
    }

    .no-posts h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .no-posts p {
        color: #6b7280;
        font-size: 1rem;
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .adoption-card {
            padding: 32px;
        }
        
        .adoption-grid {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }
    }

    @media (max-width: 767px) {
        .adoption-index-page {
            padding: 40px 0;
        }
        
        .adoption-card {
            padding: 24px;
        }
        
        .filter-section {
            padding: 24px;
        }
        
        .filter-actions {
            flex-direction: column;
        }
        
        .filter-section .btn {
            width: 100%;
            justify-content: center;
        }
        
        .adoption-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .adoption-content {
            padding: 24px;
        }
    }

    @media (max-width: 576px) {
        .adoption-image-container,
        .adoption-placeholder {
            height: 220px;
        }
        
        .adoption-title {
            font-size: 1.3rem;
        }
        
        .no-posts {
            padding: 60px 20px;
        }
    }

    /* Breadcrumb Styles - UNCHANGED */
    .breadcrumb-area {
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        position: relative;
        z-index: 1;
    }

    .breadcrumb-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

    .breadcrumb-content .title {
        color: #fff;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .breadcrumb .breadcrumb-item a {
        color: #ddd;
        text-decoration: none;
    }

    .breadcrumb .breadcrumb-item a:hover {
        color: #fff;
    }

    .breadcrumb .breadcrumb-item.active {
        color: #fff;
    }

    @media (max-width: 767px) {
        .breadcrumb-content .title {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .breadcrumb-content .title {
            font-size: 1.5rem;
        }
    }
</style>

<script>
function openImageModal(imageSrc, title) {
    if (!imageSrc) return; // Don't open modal for placeholder images
    
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    
    modalImage.src = imageSrc;
    modalTitle.textContent = title;
    modal.classList.add('show');
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('show');
    
    // Restore body scroll
    document.body.style.overflow = 'auto';
}

// Close modal on Escape key press
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageModal();
    }
});

// Prevent modal from closing when clicking on the image
document.getElementById('modalImage').addEventListener('click', function(event) {
    event.stopPropagation();
});
</script>
@endsection