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
<style>
    .rescue-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 0;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .rescue-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M20 20h10v10H20zM40 40h10v10H40zM60 20h10v10H60zM80 60h10v10H80z" fill="rgba(255,255,255,0.05)"/></svg>');
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .rescue-section {
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .rescue-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        padding: 40px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .header-section {
        text-align: center;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 2.5rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .section-subtitle {
        color: #666;
        font-size: 1.1rem;
        margin: 0;
    }

    .upload-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    /* Updated Form Styles - Responsive */
    .upload-form-container {
        display: none;
        background: linear-gradient(135deg, #f8f9ff, #e6e9ff);
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 30px;
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .modern-input, .modern-select, .modern-textarea {
        border: 2px solid #e1e5e9;
        border-radius: 15px;
        padding: 12px 18px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
        width: 100%;
        min-height: 48px;
    }

    .modern-input:focus, .modern-select:focus, .modern-textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        outline: none;
    }

    .modern-map {
        height: 300px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-top: 15px;
        width: 100%;
    }

    .map-info {
        background: white;
        padding: 15px;
        border-radius: 10px;
        margin-top: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        font-size: 14px;
        word-wrap: break-word;
    }

    .modern-btn {
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-right: 10px;
        min-width: 120px;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
    }

    .location-options {
        width: 100%;
    }

    .location-options .row {
        margin: 0;
    }

    .location-options .col-md-4,
    .location-options .col-md-8 {
        padding: 0 7.5px;
    }

    /* Responsive Filter Section Styles */
    .filter-section {
        background: linear-gradient(135deg, #f8f9ff 0%, #e8ecff 100%);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(102, 126, 234, 0.1);
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .filter-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-title i {
        color: #667eea;
        font-size: 1.1rem;
    }

    .toggle-filter {
        border: 2px solid #667eea;
        color: #667eea;
        border-radius: 25px;
        padding: 8px 20px;
        transition: all 0.3s ease;
        background: white;
        white-space: nowrap;
    }

    .toggle-filter:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
    }

    .filter-content {
        opacity: 1;
        max-height: 500px;
        overflow: hidden;
        transition: all 0.5s ease;
    }

    .filter-content.hidden {
        opacity: 0;
        max-height: 0;
        padding: 0;
        margin: 0;
    }

    .filter-group {
        position: relative;
        margin-bottom: 20px;
    }

    .filter-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .filter-label i {
        color: #667eea;
        font-size: 0.85rem;
    }

    .modern-filter-select {
        border: 2px solid #e1e5e9;
        border-radius: 15px;
        padding: 12px 18px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
        height: 50px;
        width: 100%;
    }

    .modern-filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        outline: none;
    }

    .modern-filter-select:hover {
        border-color: #667eea;
    }

    .filter-actions {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(102, 126, 234, 0.1);
        flex-wrap: wrap;
    }

    .filter-apply-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        white-space: nowrap;
    }

    .filter-apply-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .filter-clear-btn {
        border: 2px solid #6c757d;
        color: #6c757d;
        background: white;
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .filter-clear-btn:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
    }

    .filter-count {
        margin-left: auto;
    }

    .filter-count .badge {
        font-size: 0.9rem;
        padding: 10px 16px;
        border-radius: 20px;
        background: linear-gradient(135deg, #17a2b8, #138496);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .rescue-posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .rescue-post-item {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .rescue-post-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .rescue-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .rescue-post-item:hover .rescue-image {
        transform: scale(1.05);
    }

    .rescue-placeholder {
        width: 100%;
        height: 220px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
    }

    .rescue-placeholder i {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .post-details {
        padding: 20px;
    }

    .rescue-title {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .rescue-meta {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rescued-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
        display: inline-block;
        animation: pulse 2s infinite;
    }

    .read-more-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .read-more-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .no-posts {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
    }

    .no-posts-content {
        background: linear-gradient(135deg, #f8f9ff, #e6e9ff);
        padding: 40px;
        border-radius: 20px;
        display: inline-block;
    }

    .no-posts-icon {
        font-size: 4rem;
        color: #667eea;
        margin-bottom: 20px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    .pagination-wrapper {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .modern-pagination {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .modern-pagination .page-link {
        border: none;
        padding: 12px 18px;
        color: #667eea;
        background: white;
        transition: all 0.3s ease;
        border-right: 1px solid #e1e5e9;
    }

    .modern-pagination .page-item:last-child .page-link {
        border-right: none;
    }

    .modern-pagination .page-link:hover {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        transform: translateY(-2px);
    }

    .modern-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }

    /* Responsive Styles for Form */
    @media (max-width: 1199px) {
        .upload-form-container {
            padding: 25px;
        }
        
        .modern-input, .modern-select, .modern-textarea {
            padding: 10px 15px;
            font-size: 13px;
        }
        
        .modern-map {
            height: 280px;
        }
        
        .filter-section {
            padding: 20px;
        }
        
        .filter-title {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 991px) {
        .upload-form-container {
            padding: 20px;
        }
        
        .form-label {
            font-size: 14px;
            margin-bottom: 6px;
        }
        
        .modern-input, .modern-select, .modern-textarea {
            padding: 10px 14px;
            font-size: 13px;
            border-radius: 12px;
            min-height: 45px;
        }
        
        .modern-map {
            height: 260px;
        }
        
        .map-info {
            padding: 12px;
            font-size: 13px;
        }
        
        .modern-btn {
            padding: 10px 20px;
            font-size: 14px;
            margin-right: 8px;
            min-width: 110px;
        }
        
        .location-options .col-md-4,
        .location-options .col-md-8 {
            padding: 0 5px;
        }
        
        .filter-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .filter-title {
            font-size: 1.1rem;
        }
        
        .toggle-filter {
            align-self: flex-end;
            padding: 10px 20px;
        }
        
        .filter-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .filter-count {
            margin-left: 0;
            align-self: center;
            margin-top: 10px;
        }
    }

    @media (max-width: 767px) {
        .section-title {
            font-size: 2rem;
        }
        
        .rescue-card {
            padding: 25px;
        }
        
        .rescue-posts-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .rescue-image, .rescue-placeholder {
            height: 200px;
        }
        
        .upload-form-container {
            padding: 15px;
            border-radius: 15px;
        }
        
        .form-label {
            font-size: 13px;
            margin-bottom: 5px;
        }
        
        .modern-input, .modern-select, .modern-textarea {
            padding: 8px 12px;
            font-size: 12px;
            border-radius: 10px;
            min-height: 42px;
        }
        
        .modern-textarea {
            min-height: 80px;
        }
        
        .modern-map {
            height: 240px;
            border-radius: 12px;
        }
        
        .map-info {
            padding: 10px;
            font-size: 12px;
            border-radius: 8px;
        }
        
        .modern-btn {
            padding: 8px 16px;
            font-size: 13px;
            margin-right: 5px;
            margin-bottom: 8px;
            min-width: 100px;
            border-radius: 20px;
        }
        
        .location-options .row {
            margin: 0 -5px;
        }
        
        .location-options .col-md-4,
        .location-options .col-md-8 {
            padding: 0 5px;
            margin-bottom: 10px;
        }
        
        .location-options .col-md-4 {
            margin-bottom: 10px;
        }
        
        .location-options .col-md-8 {
            margin-bottom: 15px;
        }
        
        .filter-section {
            padding: 15px;
            border-radius: 15px;
        }
        
        .filter-header {
            margin-bottom: 15px;
        }
        
        .filter-title {
            font-size: 1rem;
            gap: 8px;
        }
        
        .filter-title i {
            font-size: 0.9rem;
        }
        
        .toggle-filter {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        
        .filter-group {
            margin-bottom: 15px;
        }
        
        .filter-label {
            font-size: 0.85rem;
            gap: 6px;
        }
        
        .modern-filter-select {
            padding: 10px 15px;
            font-size: 13px;
            height: 45px;
            border-radius: 12px;
        }
        
        .filter-actions {
            margin-top: 15px;
            padding-top: 15px;
            gap: 10px;
        }
        
        .filter-apply-btn,
        .filter-clear-btn {
            padding: 10px 20px;
            font-size: 0.9rem;
            border-radius: 20px;
            width: 100%;
            text-align: center;
        }
        
        .filter-count .badge {
            font-size: 0.85rem;
            padding: 8px 14px;
        }
    }

    @media (max-width: 575px) {
        .upload-form-container {
            padding: 12px;
            border-radius: 12px;
        }
        
        .form-label {
            font-size: 12px;
            margin-bottom: 4px;
            display: block;
        }
        
        .modern-input, .modern-select, .modern-textarea {
            padding: 6px 10px;
            font-size: 11px;
            border-radius: 8px;
            min-height: 38px;
        }
        
        .modern-textarea {
            min-height: 70px;
        }
        
        .modern-map {
            height: 220px;
            border-radius: 10px;
        }
        
        .map-info {
            padding: 8px;
            font-size: 11px;
            border-radius: 6px;
        }
        
        .modern-btn {
            padding: 6px 14px;
            font-size: 12px;
            margin-right: 4px;
            margin-bottom: 6px;
            min-width: 90px;
            border-radius: 18px;
            width: 100%;
            text-align: center;
        }
        
        .location-options .row {
            margin: 0 -3px;
        }
        
        .location-options .col-md-4,
        .location-options .col-md-8 {
            padding: 0 3px;
            margin-bottom: 8px;
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .col-12 {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .col-12 .modern-btn {
            margin-right: 0;
            margin-bottom: 0;
        }
        
        .filter-section {
            padding: 12px;
            margin-bottom: 20px;
        }
        
        .filter-title {
            font-size: 0.95rem;
        }
        
        .toggle-filter {
            padding: 6px 12px;
            font-size: 0.85rem;
        }
        
        .filter-group {
            margin-bottom: 12px;
        }
        
        .filter-label {
            font-size: 0.8rem;
            margin-bottom: 6px;
        }
        
        .modern-filter-select {
            padding: 8px 12px;
            font-size: 12px;
            height: 40px;
            border-radius: 10px;
        }
        
        .filter-actions {
            margin-top: 12px;
            padding-top: 12px;
            gap: 8px;
        }
        
        .filter-apply-btn,
        .filter-clear-btn {
            padding: 8px 16px;
            font-size: 0.85rem;
        }
        
        .filter-count .badge {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
    }

    @media (max-width: 400px) {
        .upload-form-container {
            padding: 10px;
            border-radius: 10px;
        }
        
        .form-label {
            font-size: 11px;
            margin-bottom: 3px;
        }
        
        .modern-input, .modern-select, .modern-textarea {
            padding: 5px 8px;
            font-size: 10px;
            border-radius: 6px;
            min-height: 35px;
        }
        
        .modern-textarea {
            min-height: 60px;
        }
        
        .modern-map {
            height: 200px;
            border-radius: 8px;
        }
        
        .map-info {
            padding: 6px;
            font-size: 10px;
            border-radius: 5px;
        }
        
        .modern-btn {
            padding: 5px 12px;
            font-size: 11px;
            min-width: 80px;
            border-radius: 15px;
        }
        
        .location-options .row {
            margin: 0 -2px;
        }
        
        .location-options .col-md-4,
        .location-options .col-md-8 {
            padding: 0 2px;
            margin-bottom: 6px;
        }
    }

    /* Ensure form elements don't overflow */
    .upload-form-container * {
        box-sizing: border-box;
    }

    /* Fix for Bootstrap grid system in form */
    .upload-form-container .row {
        margin-left: -7.5px;
        margin-right: -7.5px;
    }

    .upload-form-container .col-md-6,
    .upload-form-container .col-md-12 {
        padding-left: 7.5px;
        padding-right: 7.5px;
    }

    @media (max-width: 767px) {
        .upload-form-container .row {
            margin-left: -5px;
            margin-right: -5px;
        }
        
        .upload-form-container .col-md-6,
        .upload-form-container .col-md-12 {
            padding-left: 5px;
            padding-right: 5px;
        }
    }

    @media (max-width: 575px) {
        .upload-form-container .row {
            margin-left: -3px;
            margin-right: -3px;
        }
        
        .upload-form-container .col-md-6,
        .upload-form-container .col-md-12 {
            padding-left: 3px;
            padding-right: 3px;
        }
        
        .modern-select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px 12px;
            padding-right: 35px;
        }
        
        .modern-input[type="file"] {
            padding: 4px 8px;
            font-size: 10px;
        }
        
        .modern-textarea {
            resize: vertical;
            min-height: 60px;
            max-height: 120px;
        }
    }

    /* Responsive fixes for all content */
    @media (max-width: 767px) {
        .filter-content .row {
            margin: 0;
        }
        
        .filter-content .col-lg-4,
        .filter-content .col-md-6 {
            padding: 0;
            margin-bottom: 15px;
        }
        
        .filter-content .col-lg-4:last-child,
        .filter-content .col-md-6:last-child {
            margin-bottom: 0;
        }
    }

    @media (max-width: 991px) {
        .filter-content .g-3 {
            --bs-gutter-x: 1rem;
            --bs-gutter-y: 1rem;
        }
    }

    @media (max-width: 767px) {
        .filter-content .g-3 {
            --bs-gutter-x: 0.5rem;
            --bs-gutter-y: 0.5rem;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS (Animate On Scroll)
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true
    });

    document.getElementById('upload-post-btn').addEventListener('click', function() {
        const form = document.getElementById('upload-post-form');
        form.style.display = 'block';
        this.style.display = 'none';
        setTimeout(() => initMap(), 100);
    });

    document.getElementById('cancel-upload-btn').addEventListener('click', function() {
        document.getElementById('upload-post-form').style.display = 'none';
        document.getElementById('upload-post-btn').style.display = 'block';
    });

    // Toggle filter visibility
    document.getElementById('toggle-filter').addEventListener('click', function() {
        const filterContent = document.getElementById('filter-content');
        filterContent.classList.toggle('hidden');
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-chevron-down');
        icon.classList.toggle('fa-chevron-up');
    });

    // Clear filters functionality
    document.getElementById('clear-filters').addEventListener('click', function() {
        const form = document.getElementById('filter-form');
        document.getElementById('animal_type_filter').value = '';
        document.getElementById('district_filter').value = '';
        document.getElementById('healthy_status_filter').value = '';
        form.submit();
    });

    function initMap() {
        const districtSelect = document.getElementById('district');
        const placeInput = document.getElementById('place');
        const placeNameSpan = document.getElementById('place-name');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        const districtCoords = {
            'Colombo': [6.9271, 79.8612], 'Gampaha': [7.0887, 79.9998], 'Kalutara': [6.5833, 79.9608],
            'Kandy': [7.2906, 80.6337], 'Matale': [7.4680, 80.6227], 'Nuwara Eliya': [6.9705, 80.7820],
            'Galle': [6.0437, 80.2168], 'Matara': [5.9485, 80.5353], 'Hambantota': [6.1237, 81.1185],
            'Jaffna': [9.6615, 80.0255], 'Kilinochchi': [9.3962, 80.4027], 'Mannar': [8.9779, 79.9167],
            'Vavuniya': [8.7617, 80.4985], 'Mullaitivu': [9.2674, 80.8136], 'Batticaloa': [7.7105, 81.7007],
            'Ampara': [7.2969, 81.6750], 'Trincomalee': [8.5778, 81.2083], 'Kurunegala': [7.4833, 80.3667],
            'Puttalam': [8.0362, 79.8310], 'Anuradhapura': [8.3149, 80.4027], 'Polonnaruwa': [7.9385, 81.0050],
            'Badulla': [6.9932, 81.0548], 'Moneragala': [6.8728, 81.3497], 'Ratnapura': [6.6847, 80.3864],
            'Kegalle': [7.2528, 80.3468]
        };

        let map = L.map('map').setView([7.8731, 80.7718], 8);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        let districtCircle;

        districtSelect.addEventListener('change', function() {
            const district = this.value;
            if (district && districtCoords[district]) {
                const coords = districtCoords[district];
                map.setView(coords, 10);

                if (districtCircle) map.removeLayer(districtCircle);

                districtCircle = L.circle(coords, {
                    radius: 15000,
                    color: '#667eea',
                    fillColor: '#764ba2',
                    fillOpacity: 0.3
                }).addTo(map);
            } else {
                map.setView([7.8731, 80.7718], 8);
                if (districtCircle) map.removeLayer(districtCircle);
            }
        });

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lon = e.latlng.lng;

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1`)
                .then(response => response.json())
                .then(data => {
                    const fullPlace = data.display_name || 'Unknown location';
                    placeInput.value = fullPlace;
                    placeNameSpan.textContent = fullPlace;
                    latitudeInput.value = lat;
                    longitudeInput.value = lon;

                    L.popup()
                        .setLatLng([lat, lon])
                        .setContent(`<b>📍 Place:</b><br>${fullPlace}`)
                        .openOn(map);
                })
                .catch(error => {
                    console.error('Error:', error);
                    placeNameSpan.textContent = 'Failed to get location';
                    placeInput.value = '';
                    latitudeInput.value = '';
                    longitudeInput.value = '';
                });
        });
    }
</script>
@endsection