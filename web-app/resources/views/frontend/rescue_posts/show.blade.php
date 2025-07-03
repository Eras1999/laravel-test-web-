@extends('frontend.layouts.master')

@section('content')
<main class="rescue-detail-page">
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Rescue Mission Details</h1>
            <p class="hero-subtitle">Every animal deserves a second chance</p>
        </div>
    </div>

    <section class="rescue-detail-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="rescue-detail-card">
                        <div class="status-badge-container">
                            @if ($rescuePost->rescued)
                                <span class="status-badge rescued">
                                    <i class="fas fa-heart"></i> Successfully Rescued
                                </span>
                            @else
                                <span class="status-badge urgent">
                                    <i class="fas fa-exclamation-circle"></i> Needs Help
                                </span>
                            @endif
                        </div>

                        <div class="image-container">
                            @if ($rescuePost->image)
                                <img src="{{ asset('storage/' . $rescuePost->image) }}" alt="Rescue Image" class="rescue-detail-image">
                                <div class="image-overlay">
                                    <button class="zoom-btn" onclick="openImageModal()">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            @else
                                <div class="rescue-placeholder">
                                    <i class="fas fa-paw"></i>
                                    <p>No image available</p>
                                </div>
                            @endif
                        </div>

                        <div class="rescue-info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Reported by</span>
                                    <span class="info-value">{{ $rescuePost->author_name }}</span>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-paw"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Animal Type</span>
                                    <span class="info-value">{{ $rescuePost->animal_type }}</span>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Health Status</span>
                                    <span class="info-value status-{{ strtolower(str_replace(' ', '-', $rescuePost->healthy_status)) }}">
                                        {{ $rescuePost->healthy_status }}
                                    </span>
                                </div>
                            </div>

                            <div class="info-card location-card">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Location</span>
                                    <span class="info-value">{{ $rescuePost->place ?? 'N/A' }}, {{ $rescuePost->district }}</span>
                                    <div class="location-actions">
                                        <button class="btn-map" onclick="showMapPopup()">
                                            <i class="fas fa-eye"></i> View Map
                                        </button>
                                        @if ($rescuePost->latitude && $rescuePost->longitude)
                                            <a href="https://www.google.com/maps?q={{ $rescuePost->latitude }},{{ $rescuePost->longitude }}" 
                                               class="btn-directions" target="_blank">
                                                <i class="fas fa-directions"></i> Get Directions
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="description-section">
                            <h3><i class="fas fa-file-alt"></i> Description</h3>
                            <p class="description-text">{{ $rescuePost->description }}</p>
                        </div>

                        <!-- Map Modal -->
                        <div id="mapModal" class="modal-overlay">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5><i class="fas fa-map"></i> Location Map</h5>
                                    <button class="close-btn" onclick="closeMapPopup()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div id="modalMap"></div>
                            </div>
                        </div>

                        <!-- Image Modal -->
                        <div id="imageModal" class="modal-overlay">
                            <div class="image-modal-content">
                                <button class="close-btn" onclick="closeImageModal()">
                                    <i class="fas fa-times"></i>
                                </button>
                                @if ($rescuePost->image)
                                    <img src="{{ asset('storage/' . $rescuePost->image) }}" alt="Rescue Image" class="modal-image">
                                @endif
                            </div>
                        </div>

                        <!-- Comments Section -->
                        <div class="comments-section">
                            <div class="comments-header">
                                <h3><i class="fas fa-comments"></i> Community Comments</h3>
                                <span class="comment-count">{{ count($comments) }} comments</span>
                            </div>
                            
                            <div class="comments-list">
                                @forelse ($comments as $comment)
                                    <div class="comment-item">
                                        <div class="comment-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <span class="comment-author">{{ $comment['user_name'] }}</span>
                                                <span class="comment-time">{{ $comment['created_at']->format('d M Y H:i') }}</span>
                                            </div>
                                            <p class="comment-text">{{ $comment['comment'] }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="no-comments">
                                        <i class="fas fa-comment-slash"></i>
                                        <p>No comments yet. Be the first to share your thoughts!</p>
                                    </div>
                                @endforelse
                            </div>

                            <form action="{{ route('rescue-posts.comment', $rescuePost->id) }}" method="POST" class="comment-form">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" class="comment-input" rows="3" 
                                              placeholder="Share your thoughts or offer help..." required></textarea>
                                </div>
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i> Post Comment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
* { box-sizing: border-box; }

.rescue-detail-page {
    background: linear-gradient(135deg, #b2b2b2 0%, #ffffff 100%);
    min-height: 100vh;
    position: relative;
}

.hero-section {
    padding: 60px 0 40px;
    text-align: center;
    color: white;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 0;
}

.rescue-detail-section {
    padding-bottom: 60px;
}

.rescue-detail-card {
    background: white;
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    overflow: hidden;
    position: relative;
}

.status-badge-container {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 10;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.status-badge.rescued {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
}

.status-badge.urgent {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.image-container {
    position: relative;
    margin: 0;
}

.rescue-detail-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.zoom-btn {
    background: rgba(255,255,255,0.9);
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.zoom-btn:hover {
    transform: scale(1.1);
}

.rescue-placeholder {
    height: 300px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.rescue-placeholder i {
    font-size: 4rem;
    margin-bottom: 10px;
}

.rescue-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 30px;
}

.info-card {
    background: #f8f9fa;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.info-icon {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
}

.info-label {
    display: block;
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    font-size: 1.1rem;
}

.location-actions {
    margin-top: 10px;
    display: flex;
    gap: 8px;
}

.btn-map, .btn-directions {
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.btn-map {
    background: #667eea;
    color: white;
}

.btn-directions {
    background: #28a745;
    color: white;
}

.btn-map:hover, .btn-directions:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.description-section {
    padding: 0 30px 30px;
}

.description-section h3 {
    color: #2c3e50;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.description-text {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid #667eea;
    margin: 0;
    line-height: 1.6;
}

.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    z-index: 9999;
    backdrop-filter: blur(5px);
}

.modal-content {
    width: 90%;
    max-width: 700px;
    margin: 5% auto;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.modal-header {
    padding: 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.close-btn {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

#modalMap {
    height: 400px;
    width: 100%;
}

.image-modal-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
    margin: 5% auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-image {
    max-width: 100%;
    max-height: 100%;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.image-modal-content .close-btn {
    position: absolute;
    top: -50px;
    right: 0;
    background: rgba(255,255,255,0.9);
    color: #333;
}

.comments-section {
    padding: 30px;
    border-top: 1px solid #e9ecef;
    background: #f8f9fa;
}

.comments-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.comments-header h3 {
    margin: 0;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 10px;
}

.comment-count {
    background: #667eea;
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.85rem;
}

.comment-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    background: white;
    padding: 15px;
    border-radius: 12px;
}

.comment-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.comment-content {
    flex: 1;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.comment-author {
    font-weight: 600;
    color: #2c3e50;
}

.comment-time {
    font-size: 0.8rem;
    color: #6c757d;
}

.comment-text {
    margin: 0;
    line-height: 1.5;
    color: #495057;
}

.no-comments {
    text-align: center;
    padding: 40px;
    color: #6c757d;
}

.no-comments i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

.comment-form {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-top: 20px;
}

.comment-input {
    width: 100%;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 15px;
    font-size: 1rem;
    resize: vertical;
    transition: border-color 0.2s ease;
    margin-bottom: 15px;
}

.comment-input:focus {
    outline: none;
    border-color: #667eea;
}

.submit-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

@media (max-width: 767px) {
    .hero-title { font-size: 2rem; }
    .rescue-detail-image, .rescue-placeholder { height: 250px; }
    .rescue-info-grid { grid-template-columns: 1fr; padding: 20px; }
    .modal-content { margin: 10% auto; width: 95%; }
    .comment-item { flex-direction: column; gap: 10px; }
    .comments-header { flex-direction: column; gap: 10px; align-items: flex-start; }
}
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    let map = null;

    function initializeMap() {
        const lat = {{ $rescuePost->latitude ?? '7.8731' }};
        const lon = {{ $rescuePost->longitude ?? '80.7718' }};
        map = L.map('modalMap').setView([lat, lon], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        L.marker([lat, lon])
            .addTo(map)
            .bindPopup(`{{ $rescuePost->place ?? 'Unknown Place' }}, {{ $rescuePost->district ?? '' }}`)
            .openPopup();
    }

    function showMapPopup() {
        document.getElementById("mapModal").style.display = "block";
        if (!map) {
            initializeMap();
        } else {
            const lat = {{ $rescuePost->latitude ?? '7.8731' }};
            const lon = {{ $rescuePost->longitude ?? '80.7718' }};
            map.setView([lat, lon], 14);
            map.eachLayer(layer => {
                if (layer instanceof L.Marker) {
                    layer.setLatLng([lat, lon]).bindPopup(`{{ $rescuePost->place ?? 'Unknown Place' }}, {{ $rescuePost->district ?? '' }}`).openPopup();
                }
            });
        }
    }

    function closeMapPopup() {
        if (map) {
            map.remove();
            map = null;
        }
        document.getElementById("mapModal").style.display = "none";
    }

    function openImageModal() {
        document.getElementById("imageModal").style.display = "block";
    }

    function closeImageModal() {
        document.getElementById("imageModal").style.display = "none";
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) {
            closeMapPopup();
            closeImageModal();
        }
    });

    // Add smooth scrolling to comments when form is submitted
    document.querySelector('.comment-form').addEventListener('submit', function() {
        setTimeout(() => {
            document.querySelector('.comments-section').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }, 100);
    });
</script>
@endsection