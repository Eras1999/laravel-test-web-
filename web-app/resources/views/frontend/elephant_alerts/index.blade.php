@extends('frontend.layouts.master')

@section('content')
<section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/elephant_cover.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="title">Elephant Alert</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.authenticated') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Elephant Alert</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title">Elephant Alert</h1>
        <p class="hero-subtitle">Report elephant sightings to help protect wildlife in Sri Lanka</p>
    </div>
</div>

<main class="elephant-alerts-page">
    <section class="elephant-alerts-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="apply-section">
                        <div class="apply-card">
                            <div class="apply-header">
                                <h3>Report Elephant Sighting</h3>
                                <p>Share details about elephant sightings in your area</p>
                            </div>
                            <button class="btn-modern btn-accent" id="report-alert-btn">
                                <i class="fas fa-plus"></i> Report Now
                            </button>
                            <a href="{{ route('elephant-alerts.map') }}" class="btn-modern btn-primary mt-3">
                                <i class="fas fa-map"></i> View Sightings Map
                            </a>
                        </div>
                        
                        <div id="report-alert-form" class="apply-form-container" style="display: none;">
                            <form action="{{ route('elephant-alerts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" id="name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="text" name="mobile_number" id="mobile_number" placeholder="0771234567" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">District</label>
                                        <select name="district" id="district" required>
                                            <option value="">Select District</option>
                                            @foreach (['Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 'Moneragala', 'Ratnapura', 'Kegalle'] as $district)
                                                <option value="{{ $district }}">{{ $district }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <button type="button" class="btn-modern btn-primary" id="select-location-btn">
                                            <i class="fas fa-map-marker-alt"></i> Select Location
                                        </button>
                                        <input type="hidden" name="latitude" id="latitude" required>
                                        <input type="hidden" name="longitude" id="longitude" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Elephant Image (Optional)</label>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="elephant_count">Number of Elephants Seen</label>
                                        <input type="number" name="elephant_count" id="elephant_count" min="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="health_status">Elephant Health Status</label>
                                        <select name="health_status" id="health_status" required>
                                            <option value="healthy">Healthy</option>
                                            <option value="normal">Normal</option>
                                            <option value="injured">Injured</option>
                                        </select>
                                    </div>
                                    <div class="form-group full-width">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" rows="3" placeholder="Describe the sighting..." required></textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-modern btn-success">
                                        <i class="fas fa-check"></i> Submit Report
                                    </button>
                                    <button type="button" class="btn-modern btn-cancel" id="cancel-report-btn">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Select Location</h5>
                   
                </div>
                <div class="modal-body">
                    <div id="map" style="height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirm-location-btn">Confirm Location</button>
                    <button type="button" class="btn btn-secondary" id="cancel-map-btn" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/elephant_alerts.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { width: 100%; height: 400px; }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('report-alert-btn').addEventListener('click', function() {
        document.getElementById('report-alert-form').style.display = 'block';
        this.style.display = 'none';
    });

    document.getElementById('cancel-report-btn').addEventListener('click', function() {
        document.getElementById('report-alert-form').style.display = 'none';
        document.getElementById('report-alert-btn').style.display = 'block';
    });

    let map, marker, districtCircle;
    const sriLankaBounds = [[5.9, 79.5], [9.9, 82.0]]; // Sri Lanka bounds
    const districtCenters = {
        'Colombo': { center: [6.9271, 79.8612], radius: 20000 },
        'Gampaha': { center: [7.0873, 80.0144], radius: 25000 },
        'Kalutara': { center: [6.5854, 79.9607], radius: 20000 },
        'Kandy': { center: [7.2906, 80.6337], radius: 25000 },
        'Matale': { center: [7.4675, 80.6234], radius: 30000 },
        'Nuwara Eliya': { center: [6.9497, 80.7891], radius: 25000 },
        'Galle': { center: [6.0535, 80.2210], radius: 20000 },
        'Matara': { center: [5.9485, 80.5353], radius: 20000 },
        'Hambantota': { center: [6.1429, 81.1212], radius: 35000 },
        'Jaffna': { center: [9.6615, 80.0255], radius: 25000 },
        'Kilinochchi': { center: [9.3803, 80.3770], radius: 30000 },
        'Mannar': { center: [8.9803, 79.9044], radius: 30000 },
        'Vavuniya': { center: [8.7542, 80.4982], radius: 25000 },
        'Mullaitivu': { center: [9.2671, 80.8142], radius: 30000 },
        'Batticaloa': { center: [7.7162, 81.6921], radius: 30000 },
        'Ampara': { center: [7.2978, 81.6747], radius: 35000 },
        'Trincomalee': { center: [8.5874, 81.2152], radius: 30000 },
        'Kurunegala': { center: [7.4863, 80.3659], radius: 30000 },
        'Puttalam': { center: [8.0362, 79.8283], radius: 30000 },
        'Anuradhapura': { center: [8.3122, 80.4036], radius: 35000 },
        'Polonnaruwa': { center: [7.9403, 81.0188], radius: 30000 },
        'Badulla': { center: [6.9934, 81.0550], radius: 30000 },
        'Moneragala': { center: [6.8721, 81.3507], radius: 35000 },
        'Ratnapura': { center: [6.7056, 80.3847], radius: 30000 },
        'Kegalle': { center: [7.2513, 80.3463], radius: 25000 }
    };

    $('#mapModal').on('shown.bs.modal', function() {
        const selectedDistrict = document.getElementById('district').value;
        if (!selectedDistrict) {
            Swal.fire({
                title: 'Error',
                text: 'Please select a district first',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                background: '#fff',
                customClass: {
                    popup: 'swal-modern'
                }
            });
            $('#mapModal').modal('hide');
            return;
        }

        if (!map) {
            map = L.map('map', {
                zoomControl: true,
                scrollWheelZoom: false,
                maxBounds: sriLankaBounds,
                maxBoundsViscosity: 1.0
            }).setView(districtCenters[selectedDistrict].center, 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 18,
                minZoom: 8
            }).addTo(map);

            map.on('load', function() {
                districtCircle = L.circle(districtCenters[selectedDistrict].center, {
                    color: '#3388ff',
                    fillColor: '#3388ff',
                    fillOpacity: 0.2,
                    radius: districtCenters[selectedDistrict].radius
                }).addTo(map);
                map.fitBounds(districtCircle.getBounds());
            });

            map.on('click', function(e) {
                const clickLatLng = e.latlng;
                const center = L.latLng(districtCenters[selectedDistrict].center);
                const distance = center.distanceTo(clickLatLng);

                if (distance <= districtCenters[selectedDistrict].radius) {
                    if (marker) map.removeLayer(marker);
                    marker = L.marker(clickLatLng).addTo(map);
                    document.getElementById('latitude').value = clickLatLng.lat.toFixed(7);
                    document.getElementById('longitude').value = clickLatLng.lng.toFixed(7);

                    // Reverse geocoding to get place name
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${clickLatLng.lat}&lon=${clickLatLng.lng}&zoom=18&addressdetails=1`)
                        .then(response => response.json())
                        .then(data => {
                            const placeName = data.display_name || 'Unknown location';
                            marker.bindPopup(`<b>Location:</b> ${placeName}`).openPopup();
                        })
                        .catch(error => {
                            console.error('Reverse geocoding error:', error);
                            marker.bindPopup('<b>Location:</b> Unknown').openPopup();
                        });
                } else {
                    Swal.fire({
                        title: 'Invalid Location',
                        text: 'Please select a location within the district boundary',
                        icon: 'warning',
                        confirmButtonColor: '#f59e0b',
                        background: '#fff',
                        customClass: {
                            popup: 'swal-modern'
                        }
                    });
                }
            });
        } else {
            if (districtCircle) map.removeLayer(districtCircle);
            map.setView(districtCenters[selectedDistrict].center, 10);
            districtCircle = L.circle(districtCenters[selectedDistrict].center, {
                color: '#3388ff',
                fillColor: '#3388ff',
                fillOpacity: 0.2,
                radius: districtCenters[selectedDistrict].radius
            }).addTo(map);
            map.fitBounds(districtCircle.getBounds());
            if (marker) map.removeLayer(marker);
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
        }

        setTimeout(() => map.invalidateSize(), 100);
    });

    document.getElementById('select-location-btn').addEventListener('click', function() {
        const selectedDistrict = document.getElementById('district').value;
        if (!selectedDistrict) {
            Swal.fire({
                title: 'Error',
                text: 'Please select a district first',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                background: '#fff',
                customClass: {
                    popup: 'swal-modern'
                }
            });
            return;
        }
        $('#mapModal').modal('show');
    });

    document.getElementById('confirm-location-btn').addEventListener('click', function() {
        if (!document.getElementById('latitude').value || !document.getElementById('longitude').value) {
            Swal.fire({
                title: 'Error',
                text: 'Please select a location on the map',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                background: '#fff',
                customClass: {
                    popup: 'swal-modern'
                }
            });
            return;
        }
        $('#mapModal').modal('hide');
    });

    document.getElementById('cancel-map-btn').addEventListener('click', function() {
        $('#mapModal').modal('hide');
        if (marker) map.removeLayer(marker);
        document.getElementById('latitude').value = '';
        document.getElementById('longitude').value = '';
    });

    document.getElementById('district').addEventListener('change', function() {
        if (map && districtCircle) {
            map.removeLayer(districtCircle);
            if (marker) map.removeLayer(marker);
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
            const selectedDistrict = this.value;
            if (selectedDistrict && districtCenters[selectedDistrict]) {
                map.setView(districtCenters[selectedDistrict].center, 10);
                districtCircle = L.circle(districtCenters[selectedDistrict].center, {
                    color: '#3388ff',
                    fillColor: '#3388ff',
                    fillOpacity: 0.2,
                    radius: districtCenters[selectedDistrict].radius
                }).addTo(map);
                map.fitBounds(districtCircle.getBounds());
                setTimeout(() => map.invalidateSize(), 100);
            }
        }
    });

    document.querySelector('#report-alert-form form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Submit Alert?',
            text: 'Are you sure you want to submit this elephant sighting report?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#667eea',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Yes, Submit!',
            cancelButtonText: 'Cancel',
            background: '#fff',
            backdrop: 'rgba(0,0,0,0.4)',
            customClass: {
                popup: 'swal-modern',
                title: 'swal-title',
                content: 'swal-content',
                confirmButton: 'swal-confirm',
                cancelButton: 'swal-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Submitting...',
                    text: 'Please wait while we process your report',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    background: '#fff',
                    customClass: {
                        popup: 'swal-modern'
                    },
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                this.action = "{{ route('elephant-alerts.store') }}?redirect=map";
                this.submit();
            }
        });
    });

    @if(session('success'))
        Swal.fire({
            title: 'Report Submitted!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#22c55e',
            confirmButtonText: 'View Map',
            background: '#fff',
            backdrop: 'rgba(0,0,0,0.4)',
            customClass: {
                popup: 'swal-modern swal-success',
                title: 'swal-title',
                content: 'swal-content',
                confirmButton: 'swal-confirm'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('elephant-alerts.map') }}";
            }
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Oops!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Try Again',
            background: '#fff',
            backdrop: 'rgba(0,0,0,0.4)',
            customClass: {
                popup: 'swal-modern',
                title: 'swal-title',
                content: 'swal-content',
                confirmButton: 'swal-confirm'
            }
        });
    @endif
});
</script>
@endsection