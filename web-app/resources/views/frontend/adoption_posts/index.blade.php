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

    <link rel="stylesheet" href="{{ asset('frontend/css/adoption_index.css') }}">


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