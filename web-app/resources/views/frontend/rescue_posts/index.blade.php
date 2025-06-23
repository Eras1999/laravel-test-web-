@extends('frontend.layouts.master')

@section('content')
<main class="rescue-page">
    <section class="rescue-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="rescue-card">
                        <h2 class="section-title">Rescue Posts</h2>
                        <button class="btn btn-primary mb-4" id="upload-post-btn">Upload Rescue Post</button>
                        <div id="upload-post-form" style="display: none;">
                            <form action="{{ route('rescue-posts.store') }}" method="POST" enctype="multipart/form-data" id="rescue-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="author_name" class="form-label">Author Name</label>
                                        <input type="text" name="author_name" id="author_name" class="form-control" value="{{ Auth::guard('frontend')->check() ? Auth::guard('frontend')->user()->name : old('author_name') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="animal_type" class="form-label">Animal Type</label>
                                        <select name="animal_type" id="animal_type" class="form-select" required>
                                            <option value="">Select Animal Type</option>
                                            <option value="Dog">Dog</option>
                                            <option value="Cat">Cat</option>
                                            <option value="Bird">Bird</option>
                                            <option value="Snake">Snake</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="image" class="form-label">Animal Image</label>
                                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="healthy_status" class="form-label">Animal Healthy Status</label>
                                        <select name="healthy_status" id="healthy_status" class="form-select" required>
                                            <option value="">Select Status</option>
                                            <option value="Healthy but Abandoned">Healthy but Abandoned</option>
                                            <option value="Injured">Injured</option>
                                            <option value="Sick or Weak">Sick or Weak</option>
                                            <option value="In Critical Condition">In Critical Condition</option>
                                            <option value="Unknown / Not Sure">Unknown / Not Sure</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Location</label>
                                        <div class="location-options">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <select name="district" id="district" class="form-select" required>
                                                        <option value="">Select District</option>
                                                        @foreach (['Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 'Moneragala', 'Ratnapura', 'Kegalle'] as $district)
                                                            <option value="{{ $district }}">{{ $district }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-8 mb-2">
                                                    <input type="text" name="place" id="place" class="form-control" placeholder="Click map to select place" required readonly>
                                                    <input type="hidden" name="latitude" id="latitude">
                                                    <input type="hidden" name="longitude" id="longitude">
                                                </div>
                                            </div>
                                            <div id="map" style="height: 300px; margin-top: 10px;"></div>
                                            <div id="info"><strong>Place name:</strong> <span id="place-name">Click on the map</span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-secondary" id="cancel-upload-btn">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="rescue-posts-grid">
                            @forelse ($rescuePosts as $post)
                                <div class="rescue-post-item">
                                    <div class="rescue-post-content">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="Rescue Image" class="rescue-image">
                                        @else
                                            <div class="rescue-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                        <h5 class="rescue-title">Type: {{ $post->animal_type }}</h5>
                                        <p class="rescue-meta">Status: {{ $post->healthy_status }}</p>
                                        <p class="rescue-meta">Location: {{ $post->place ?? 'N/A' }}, {{ $post->district }}</p>
                                        @if ($post->rescued)
                                            <span class="badge bg-success">Rescued</span>
                                        @endif
                                        <a href="{{ route('rescue-posts.show', $post->id) }}" class="btn btn-primary btn-sm mt-2">Read More</a>
                                    </div>
                                </div>
                            @empty
                                <div class="no-posts">
                                    <p class="text-muted">No rescue posts available at the moment.</p>
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
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    .rescue-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 40px 0;
        min-height: 100vh;
    }

    .rescue-section {
        width: 100%;
    }

    .rescue-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .rescue-posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .rescue-post-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .rescue-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .rescue-placeholder {
        width: 100%;
        height: 200px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px 10px 0 0;
    }

    .rescue-placeholder i {
        font-size: 2.5rem;
        color: #ccc;
    }

    .rescue-title {
        font-size: 1.2rem;
        color: #333;
        margin: 10px;
    }

    .rescue-meta {
        font-size: 0.9rem;
        color: #666;
        margin: 5px 10px;
    }

    .badge {
        margin: 5px 10px;
    }

    #map { height: 300px; }
    #info { padding: 10px; font-size: 16px; }

    @media (max-width: 767px) {
        .rescue-image, .rescue-placeholder {
            height: 200px;
        }
        #map { height: 200px; }
    }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.getElementById('upload-post-btn').addEventListener('click', function() {
        document.getElementById('upload-post-form').style.display = 'block';
        this.style.display = 'none';
        initMap();
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
            'Colombo': [6.9271, 79.8612],
            'Gampaha': [7.0887, 79.9998],
            'Kalutara': [6.5833, 79.9608],
            'Kandy': [7.2906, 80.6337],
            'Matale': [7.4680, 80.6227],
            'Nuwara Eliya': [6.9705, 80.7820],
            'Galle': [6.0437, 80.2168],
            'Matara': [5.9485, 80.5353],
            'Hambantota': [6.1237, 81.1185],
            'Jaffna': [9.6615, 80.0255],
            'Kilinochchi': [9.3962, 80.4027],
            'Mannar': [8.9779, 79.9167],
            'Vavuniya': [8.7617, 80.4985],
            'Mullaitivu': [9.2674, 80.8136],
            'Batticaloa': [7.7105, 81.7007],
            'Ampara': [7.2969, 81.6750],
            'Trincomalee': [8.5778, 81.2083],
            'Kurunegala': [7.4833, 80.3667],
            'Puttalam': [8.0362, 79.8310],
            'Anuradhapura': [8.3149, 80.4027],
            'Polonnaruwa': [7.9385, 81.0050],
            'Badulla': [6.9932, 81.0548],
            'Moneragala': [6.8728, 81.3497],
            'Ratnapura': [6.6847, 80.3864],
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
                    color: '#007bff',
                    fillColor: '#3ca0ff',
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
                        .setContent(`<b>Place:</b><br>${fullPlace}`)
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