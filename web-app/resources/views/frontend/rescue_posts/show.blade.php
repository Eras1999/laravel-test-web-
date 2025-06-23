@extends('frontend.layouts.master')

@section('content')
<main class="rescue-detail-page">
    <section class="rescue-detail-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="rescue-detail-card">
                        <div class="rescue-detail-header">
                            <h2 class="section-title">Rescue Post Details</h2>
                        </div>
                        <div class="rescue-detail-content">
                            @if ($rescuePost->image)
                                <img src="{{ asset('storage/' . $rescuePost->image) }}" alt="Rescue Image" class="rescue-detail-image">
                            @else
                                <div class="rescue-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif

                            <p><strong>Author:</strong> {{ $rescuePost->author_name }}</p>
                            <p><strong>Animal Type:</strong> {{ $rescuePost->animal_type }}</p>
                            <p><strong>Healthy Status:</strong> {{ $rescuePost->healthy_status }}</p>
                            <p><strong>Location:</strong> {{ $rescuePost->place ?? 'N/A' }}, {{ $rescuePost->district }}</p>

                            <p>
                                <button class="btn btn-sm btn-outline-primary ms-2" onclick="showMapPopup()">View on Map</button>
                            </p>

                            @if ($rescuePost->latitude && $rescuePost->longitude)
                                <p>
                                    <a href="https://www.google.com/maps?q={{ $rescuePost->latitude }},{{ $rescuePost->longitude }}"
                                       class="btn btn-sm btn-outline-success mt-1" target="_blank">
                                        Open in Google Maps
                                    </a>

                                </p>
                            @endif

                            <p><strong>Description:</strong> {{ $rescuePost->description }}</p>
                            @if ($rescuePost->rescued)
                                <span class="badge bg-success">Rescued</span>
                            @endif
                        </div>

                        <!-- Map Modal -->
                        <div id="mapModal" style="display: none;">
                            <div style="position: fixed; top: 0; left: 0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index: 9999;">
                                <div style="width: 90%; max-width: 700px; margin: 80px auto; background: #fff; border-radius: 10px; padding: 20px; position: relative;">
                                    <h5>Location Map</h5>
                                    <div id="modalMap" style="height: 400px;"></div>
                                    <button class="btn btn-danger mt-3" onclick="closeMapPopup()">Close</button>
                                </div>
                            </div>
                        </div>

                        <!-- Comments Section -->
                        <div class="comments-section mt-4">
                            <h3 class="section-subtitle">Comments</h3>
                            @forelse ($comments as $comment)
                                <div class="comment-item">
                                    <p><strong>{{ $comment['user_name'] }}:</strong> {{ $comment['comment'] }} <span class="comment-time">{{ $comment['created_at']->format('d M Y H:i') }}</span></p>
                                </div>
                            @empty
                                <p class="text-muted">No comments yet.</p>
                            @endforelse
                            <form action="{{ route('rescue-posts.comment', $rescuePost->id) }}" method="POST" class="mt-3">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control" rows="3" placeholder="Add a comment..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Comment</button>
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
    .rescue-detail-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 40px 0;
        min-height: 100vh;
    }

    .rescue-detail-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .rescue-detail-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .rescue-placeholder {
        width: 100%;
        height: 300px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .rescue-placeholder i {
        font-size: 3rem;
        color: #ccc;
    }

    .comment-item {
        background: #f9f9f9;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .comment-time {
        font-size: 0.8rem;
        color: #666;
        float: right;
    }

    #modalMap {
        height: 400px;
        width: 100%;
        border-radius: 10px;
    }

    @media (max-width: 767px) {
        .rescue-detail-image,
        .rescue-placeholder {
            height: 200px;
        }
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
</script>
@endsection
