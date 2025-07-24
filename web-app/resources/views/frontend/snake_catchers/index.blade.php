@extends('frontend.layouts.master')

@section('content')
<section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/snake_cover.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="title">Professional Snake Catchers</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Professional Snake Catchers</li>
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
        <h1 class="hero-title">Professional Snake Catchers</h1>
        <p class="hero-subtitle">Connecting you with certified snake removal experts across Sri Lanka</p>
    </div>
</div>

<main class="snake-catchers-page">
    <section class="snake-catchers-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="filter-card">
                        <div class="filter-header">
                            <h3><i class="fas fa-filter"></i> Find Snake Catchers</h3>
                        </div>
                        <form id="filter-form" method="GET" action="{{ route('snake-catchers.index') }}">
                            <div class="filter-content">
                                <div class="filter-group">
                                    <label for="district">District</label>
                                    <select name="district" id="district" class="modern-select">
                                        <option value="">All Districts</option>
                                        @foreach (['Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 'Moneragala', 'Ratnapura', 'Kegalle'] as $district)
                                            <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="filter-actions">
                                    <button type="submit" class="btn-modern btn-primary">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    <a href="{{ route('snake-catchers.index') }}" class="btn-modern btn-secondary">
                                        <i class="fas fa-redo"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="catchers-grid">
                        @forelse ($snakeCatchers as $catcher)
                            <div class="catcher-card">
                                <div class="catcher-image">
                                    @if ($catcher->image)
                                        <img src="{{ asset('storage/' . $catcher->image) }}" alt="{{ $catcher->name }}">
                                    @else
                                        <div class="image-placeholder">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                    @endif
                                    <div class="card-overlay">
                                        <span class="district-badge">{{ $catcher->district }}</span>
                                    </div>
                                </div>
                                <div class="catcher-info">
                                    <h4 class="catcher-name">{{ $catcher->name }}</h4>
                                    <div class="catcher-details">
                                        <div class="detail-item">
                                            <i class="fas fa-phone"></i>
                                            <span>{{ $catcher->mobile_number }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ Str::limit($catcher->description, 80) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-search"></i>
                                <h4>No Snake Catchers Found</h4>
                                <p>Try adjusting your search filters</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="apply-section">
                        <div class="apply-card">
                            <div class="apply-header">
                                <h3>Join Our Network</h3>
                                <p>Become a certified snake catcher and help your community</p>
                            </div>
                            <button class="btn-modern btn-accent" id="apply-catcher-btn">
                                <i class="fas fa-plus"></i> Apply Now
                            </button>
                        </div>
                        
                        <div id="apply-catcher-form" class="apply-form-container">
                            <form action="{{ route('snake-catchers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" name="email" id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Profile Image</label>
                                        <input type="file" name="image" id="image" required>
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
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="text" name="mobile_number" id="mobile_number" placeholder="0771234567" required>
                                    </div>
                                    <div class="form-group full-width">
                                        <label for="description">Coverage Area</label>
                                        <textarea name="description" id="description" rows="3" placeholder="Describe the areas you can cover..." required></textarea>
                                    </div>
                                    <div class="form-group full-width">
                                        <label for="facebook_link">Facebook Profile</label>
                                        <input type="url" name="facebook_link" id="facebook_link" placeholder="https://facebook.com/yourprofile" required>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-modern btn-success">
                                        <i class="fas fa-check"></i> Submit Application
                                    </button>
                                    <button type="button" class="btn-modern btn-cancel" id="cancel-apply-btn">
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
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/snake_catchers.css') }}">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('apply-catcher-btn').addEventListener('click', function() {
    document.getElementById('apply-catcher-form').style.display = 'block';
    this.style.display = 'none';
});

document.getElementById('cancel-apply-btn').addEventListener('click', function() {
    document.getElementById('apply-catcher-form').style.display = 'none';
    document.getElementById('apply-catcher-btn').style.display = 'block';
});

// SweetAlert for form submission
document.querySelector('#apply-catcher-form form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Submit Application?',
        text: 'Are you sure you want to submit your snake catcher application?',
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
            // Show loading
            Swal.fire({
                title: 'Submitting...',
                text: 'Please wait while we process your application',
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
            
            // Submit the form
            this.submit();
        }
    });
});

// Success message (add this to your controller and pass success message)
@if(session('success'))
    Swal.fire({
        title: 'Application Submitted!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonColor: '#22c55e',
        confirmButtonText: 'Great!',
        background: '#fff',
        backdrop: 'rgba(0,0,0,0.4)',
        customClass: {
            popup: 'swal-modern swal-success',
            title: 'swal-title',
            content: 'swal-content',
            confirmButton: 'swal-confirm'
        }
    });
@endif

// Error message
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
</script>
@endsection