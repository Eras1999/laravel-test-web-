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
                                        <input type="text" name="author_name" id="author_name" class="form-control modern-input" value="{{ Auth::guard('frontend')->check() ? Auth::guard('frontend')->user()->name : old('author_name') }}" required>
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
            {{-- Previous Page Link --}}
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

            {{-- Pagination Elements --}}
            @foreach ($rescuePosts->getUrlRange(1, $rescuePosts->lastPage()) as $page => $url)
                @if ($page == $rescuePosts->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
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
    }

    .map-info {
        background: white;
        padding: 15px;
        border-radius: 10px;
        margin-top: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        font-size: 14px;
    }

    .modern-btn {
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-right: 10px;
    }

    .modern-btn:hover {
        transform: translateY(-2px);
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

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
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
        
        .modern-map {
            height: 250px;
        }
        
        .rescue-image, .rescue-placeholder {
            height: 200px;
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