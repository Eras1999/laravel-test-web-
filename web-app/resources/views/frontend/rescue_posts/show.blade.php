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

                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Contact Number</span>
                                    <span class="info-value">{{ $rescuePost->contact_number ?? 'N/A' }}</span>
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
                                @forelse ($comments as $index => $comment)
                                    <div class="comment-item">
                                        <div class="comment-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-header">
                                                <span class="comment-author">{{ $comment['user_name'] }}</span>
                                                <div class="comment-meta">
                                                    <span class="comment-time">{{ $comment['created_at']->format('d M Y H:i') }}</span>
                                                    @if (Auth::guard('frontend')->check() && isset($comment['user_id']) && $comment['user_id'] === Auth::guard('frontend')->user()->id)
                                                        <form action="{{ route('rescue-posts.delete-comment', ['id' => $rescuePost->id, 'commentIndex' => $index]) }}" method="POST" class="delete-comment-form" onsubmit="return confirmDeleteComment()">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-comment-btn">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="comment-text">{{ $comment['comment'] }}</p>
                                            @if (isset($comment['image']) && $comment['image'])
                                                <div class="comment-image-container">
                                                    <img src="{{ asset('storage/' . $comment['image']) }}" alt="Comment Image" class="comment-image">
                                                    <div class="image-overlay">
                                                        <button class="zoom-btn" onclick="openCommentImageModal('{{ asset('storage/' . $comment['image']) }}')">
                                                            <i class="fas fa-expand"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="no-comments">
                                        <i class="fas fa-comment-slash"></i>
                                        <p>No comments yet. Be the first to share your thoughts!</p>
                                    </div>
                                @endforelse
                            </div>

                            <form action="{{ route('rescue-posts.comment', $rescuePost->id) }}" method="POST" class="comment-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" class="comment-input" rows="3" 
                                              placeholder="Share your thoughts or offer help..." required></textarea>
                                    <input type="file" name="comment_image" class="form-control modern-input" accept="image/*">
                                    @error('comment_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i> Post Comment
                                </button><br>
                                <a href="{{ route('rescue-posts.index') }}" class="btn back-btn">Back</a>
                            </form>

                            <!-- Comment Image Modal -->
                            <div id="commentImageModal" class="modal-overlay">
                                <div class="image-modal-content">
                                    <button class="close-btn" onclick="closeCommentImageModal()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <img id="commentModalImage" src="" alt="Comment Image" class="modal-image">
                                </div>
                            </div>
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
<link rel="stylesheet" href="{{ asset('frontend/css/rescue-posts-show.css') }}">
<style>
.comment-image-container {
    position: relative;
    margin-top: 10px;
    max-width: 200px;
}
.comment-image {
    width: 100%;
    height: auto;
    border-radius: 8px;
}
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('frontend/js/rescue-posts-show.js') }}"></script>
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

function openCommentImageModal(imageSrc) {
    document.getElementById('commentImageModal').style.display = 'block';
    document.getElementById('commentModalImage').src = imageSrc;
}

function closeCommentImageModal() {
    document.getElementById('commentImageModal').style.display = 'none';
}
</script>
@endsection