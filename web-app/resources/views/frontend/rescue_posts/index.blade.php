@extends('frontend.layouts.master')

@section('content')
<main class="rescue-page">
    <section class="rescue-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="rescue-card">
                        <div class="header-section">
                            <h2 class="section-title">🐾 Rescue Posts</h2>
                            <p class="section-subtitle">Help save lives, one paw at a time</p>
                        </div>
                        
                        <button class="btn btn-primary mb-4 upload-btn" id="upload-post-btn">
                            <i class="fas fa-plus"></i> Upload Rescue Post
                        </button>
                        <div id="upload-post-form" class="upload-form-container">
                            <form action="{{ route('rescue-posts.store') }}" method="POST" enctype="multipart/form-data" id="rescue-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="author_name" class="form-label">👤 Author Name</label>
                                        <input type="text" name="author_name" id="author_name" class="form-control modern-input" value="{{ Auth::guard('frontend')->check() ? Auth::guard('frontend')->user()->name : old('author_name') }}" readonly required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="animal_type" class="form-label">🐾 Animal Type</label>
                                        <select name="animal_type" id="animal_type" class="form-select modern-select" required>
                                            <option value="">Select Animal Type</option>
                                            <option value="Dog">🐕 Dog</option>
                                            <option value="Cat">🐱 Cat</option>
                                            <option value="Bird">🐦 Bird</option>
                                            <option value="Snake">🐍 Snake</option>
                                            <option value="Other">🦎 Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="image" class="form-label">📸 Animal Image</label>
                                        <input type="file" name="image" id="image" class="form-control modern-input" accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="healthy_status" class="form-label">🏥 Animal Health Status</label>
                                        <select name="healthy_status" id="healthy_status" class="form-select modern-select" required>
                                            <option value="">Select Status</option>
                                            <option value="Healthy but Abandoned">💚 Healthy but Abandoned</option>
                                            <option value="Injured">🩹 Injured</option>
                                            <option value="Sick or Weak">😷 Sick or Weak</option>
                                            <option value="In Critical Condition">🚨 In Critical Condition</option>
                                            <option value="Unknown / Not Sure">❓ Unknown / Not Sure</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">📍 Location</label>
                                        <div class="location-options">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <select name="district" id="district" class="form-select modern-select" required>
                                                        <option value="">Select District</option>
                                                        @foreach (['Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 'Moneragala', 'Ratnapura', 'Kegalle'] as $district)
                                                            <option value="{{ $district }}">{{ $district }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-8 mb-2">
                                                    <input type="text" name="place" id="place" class="form-control modern-input" placeholder="📌 Click map to select place" required readonly>
                                                    <input type="hidden" name="latitude" id="latitude">
                                                    <input type="hidden" name="longitude" id="longitude">
                                                </div>
                                            </div>
                                            <div id="map" class="modern-map"></div>
                                            <div id="info" class="map-info"><strong>📍 Place name:</strong> <span id="place-name">Click on the map</span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="description" class="form-label">📝 Description</label>
                                        <textarea name="description" id="description" class="form-control modern-textarea" rows="3" required placeholder="Tell us about this animal's situation..."></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="contact_number" class="form-label">📞 Contact Number</label>
                                        <input type="text" name="contact_number" id="contact_number" class="form-control modern-input" placeholder="Enter a valid Sri Lankan phone number (e.g., +94712345678 or 0712345678)" required>
                                        @error('contact_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-success modern-btn">
                                            <i class="fas fa-heart"></i> Submit Rescue Post
                                        </button>
                                        <button type="button" class="btn btn-secondary modern-btn" id="cancel-upload-btn">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modern Filter Section -->
                        <div class="filter-section">
                            <div class="filter-header">
                                <h4 class="filter-title">
                                    <i class="fas fa-filter"></i> Find Rescue Posts
                                </h4>
                                <button type="button" class="btn btn-outline-secondary btn-sm toggle-filter" id="toggle-filter">
                                    <i class="fas fa-chevron-down"></i> Filters
                                </button>
                            </div>
                            
                            <div class="filter-content" id="filter-content">
                                <form method="GET" action="{{ route('rescue-posts.index') }}" id="filter-form">
                                    <div class="row g-3">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="filter-group">
                                                <label class="filter-label">
                                                    <i class="fas fa-paw"></i> Animal Type
                                                </label>
                                                <select name="animal_type" id="animal_type_filter" class="form-select modern-filter-select">
                                                    <option value="">All Animals</option>
                                                    <option value="Dog" {{ request('animal_type') == 'Dog' ? 'selected' : '' }}>🐕 Dog</option>
                                                    <option value="Cat" {{ request('animal_type') == 'Cat' ? 'selected' : '' }}>🐱 Cat</option>
                                                    <option value="Bird" {{ request('animal_type') == 'Bird' ? 'selected' : '' }}>🐦 Bird</option>
                                                    <option value="Snake" {{ request('animal_type') == 'Snake' ? 'selected' : '' }}>🐍 Snake</option>
                                                    <option value="Other" {{ request('animal_type') == 'Other' ? 'selected' : '' }}>🦎 Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-6">
                                            <div class="filter-group">
                                                <label class="filter-label">
                                                    <i class="fas fa-map-marker-alt"></i> District
                                                </label>
                                                <select name="district" id="district_filter" class="form-select modern-filter-select">
                                                    <option value="">All Districts</option>
                                                    @foreach ($rescuePosts->pluck('district')->unique()->filter()->values() as $district)
                                                        <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                                                            {{ $district }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-6">
                                            <div class="filter-group">
                                                <label class="filter-label">
                                                    <i class="fas fa-heartbeat"></i> Health Status
                                                </label>
                                                <select name="healthy_status" id="healthy_status_filter" class="form-select modern-filter-select">
                                                    <option value="">All Statuses</option>
                                                    <option value="Healthy but Abandoned" {{ request('healthy_status') == 'Healthy but Abandoned' ? 'selected' : '' }}>💚 Healthy but Abandoned</option>
                                                    <option value="Injured" {{ request('healthy_status') == 'Injured' ? 'selected' : '' }}>🩹 Injured</option>
                                                    <option value="Sick or Weak" {{ request('healthy_status') == 'Sick or Weak' ? 'selected' : '' }}>😷 Sick or Weak</option>
                                                    <option value="In Critical Condition" {{ request('healthy_status') == 'In Critical Condition' ? 'selected' : '' }}>🚨 In Critical Condition</option>
                                                    <option value="Unknown / Not Sure" {{ request('healthy_status') == 'Unknown / Not Sure' ? 'selected' : '' }}>❓ Unknown / Not Sure</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="filter-actions">
                                        <button type="submit" class="btn btn-primary filter-apply-btn">
                                            <i class="fas fa-search"></i> Apply Filters
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary filter-clear-btn" id="clear-filters">
                                            <i class="fas fa-times"></i> Clear All
                                        </button>
                                        <div class="filter-count">
                                            <span class="badge bg-info">{{ $rescuePosts->total() }} {{ Str::plural('result', $rescuePosts->total()) }}</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                        
                        <div class="rescue-posts-grid" id="rescue-posts-container">
                            @forelse ($rescuePosts as $index => $post)
                                <div class="rescue-post-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <div class="rescue-post-content">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="Rescue Image" class="rescue-image">
                                        @else
                                            <div class="rescue-placeholder">
                                                <i class="fas fa-image"></i>
                                                <span>No Image</span>
                                            </div>
                                        @endif
                                        <div class="post-details">
                                            <h5 class="rescue-title">
                                                @if($post->animal_type == 'Dog') 🐕 
                                                @elseif($post->animal_type == 'Cat') 🐱 
                                                @elseif($post->animal_type == 'Bird') 🐦 
                                                @elseif($post->animal_type == 'Snake') 🐍 
                                                @else 🦎 
                                                @endif
                                                {{ $post->animal_type }}
                                            </h5>
                                            <p class="rescue-meta">
                                                <i class="fas fa-heartbeat"></i> 
                                                @if($post->healthy_status == 'Healthy but Abandoned') 💚 
                                                @elseif($post->healthy_status == 'Injured') 🩹 
                                                @elseif($post->healthy_status == 'Sick or Weak') 😷 
                                                @elseif($post->healthy_status == 'In Critical Condition') 🚨 
                                                @else ❓ 
                                                @endif
                                                {{ $post->healthy_status }}
                                            </p>
                                            <p class="rescue-meta">
                                                <i class="fas fa-map-marker-alt"></i> {{ $post->place ?? 'N/A' }}, {{ $post->district }}
                                            </p>
                                            @if ($post->rescued)
                                                <span class="badge bg-success rescued-badge">✅ Rescued</span>
                                            @endif
                                            <a href="{{ route('rescue-posts.show', $post->id) }}" class="btn btn-primary btn-sm mt-2 read-more-btn">
                                                <i class="fas fa-eye"></i> Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="no-posts">
                                    <div class="no-posts-content">
                                        <i class="fas fa-paw no-posts-icon"></i>
                                        <p class="text-muted">No rescue posts available at the moment.</p>
                                        <p class="text-muted">Be the first to help an animal in need! 🐾</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Pagination -->
                        @if($rescuePosts->hasPages())
                        <div class="pagination-wrapper">
                            <nav aria-label="Rescue posts pagination">
                                <ul class="pagination modern-pagination">
                                    @if ($rescuePosts->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">
                                                <i class="fas fa-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $rescuePosts->previousPageUrl() }}" aria-label="Previous">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($rescuePosts->getUrlRange(1, $rescuePosts->lastPage()) as $page => $url)
                                        @if ($page == $rescuePosts->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    @if ($rescuePosts->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $rescuePosts->nextPageUrl() }}" aria-label="Next">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Next">
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
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/css/rescue-posts.css') }}">
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('frontend/js/rescue-posts.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session("success") }}',
    confirmButtonColor: '#667eea',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Oops!',
    text: '{{ session("error") }}',
    confirmButtonColor: '#e3342f',
});
</script>
@endif

@endsection