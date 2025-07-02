@extends('frontend.layouts.master')

@section('content')
<!-- breadcrumb-area -->
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
<!-- breadcrumb-area-end -->

<!-- Hero Banner Section -->
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
                    <!-- Modern Filter Card -->
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

                    <!-- Snake Catchers Grid -->
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

                    <!-- Apply Section -->
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
<style>
* { box-sizing: border-box; }

.hero-banner {
    height: 40vh;
    background: linear-gradient(135deg, #d0d0d0 0%, #9f9f9f 100%);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.hero-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200"><path d="M0,100 Q250,50 500,100 T1000,100 V200 H0 Z" fill="rgba(255,255,255,0.1)"/></svg>') center/cover;
}

.hero-content {
    text-align: center;
    color: white;
    z-index: 2;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.snake-catchers-page {
    background: #f8fafc;
    min-height: 60vh;
    padding: 3rem 0;
}

.filter-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
    overflow: hidden;
}

.filter-header {
    background: #46ac0b;
    padding: 1.5rem;
    color: white;
}

.filter-header h3 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.filter-content {
    padding: 2rem;
    display: flex;
    align-items: end;
    gap: 2rem;
    flex-wrap: wrap;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-group label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.modern-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.modern-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.filter-actions {
    display: flex;
    gap: 1rem;
}

.btn-modern {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-secondary {
    background: #6b7280;
    color: white;
}

.btn-accent {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
    color: white;
}

.btn-cancel {
    background: #ef4444;
    color: white;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.catchers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.catcher-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.catcher-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
}

.catcher-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.catcher-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.catcher-card:hover .catcher-image img {
    transform: scale(1.05);
}

.image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 4rem;
}

.card-overlay {
    position: absolute;
    top: 1rem;
    right: 1rem;
}

.district-badge {
    background: rgba(255,255,255,0.9);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    color: #374151;
    font-size: 0.85rem;
    backdrop-filter: blur(10px);
}

.catcher-info {
    padding: 1.5rem;
}

.catcher-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1rem;
}

.catcher-details {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.detail-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    color: #6b7280;
}

.detail-item i {
    color: #667eea;
    width: 16px;
    flex-shrink: 0;
    margin-top: 2px;
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    color: #6b7280;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #d1d5db;
}

.apply-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
}

.apply-card {
    padding: 2rem;
    text-align: center;
    background:#5abb23;
    color: white;
}

.apply-header h3 {
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

.apply-form-container {
    display: none;
    padding: 2rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.75rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .hero-title { font-size: 2rem; }
    .filter-content { flex-direction: column; align-items: stretch; }
    .catchers-grid { grid-template-columns: 1fr; }
    .form-actions { flex-direction: column; }
}

/* SweetAlert Custom Styles */
.swal-modern {
    border-radius: 20px !important;
    font-family: 'Poppins', sans-serif !important;
}

.swal-title {
    font-weight: 700 !important;
    font-size: 1.5rem !important;
}

.swal-content {
    font-size: 1rem !important;
    color: #6b7280 !important;
}

.swal-confirm {
    border-radius: 12px !important;
    padding: 0.75rem 1.5rem !important;
    font-weight: 600 !important;
    font-size: 0.95rem !important;
}

.swal-cancel {
    border-radius: 12px !important;
    padding: 0.75rem 1.5rem !important;
    font-weight: 600 !important;
    font-size: 0.95rem !important;
}

.swal-success .swal2-icon.swal2-success {
    border-color: #22c55e !important;
}

.swal-success .swal2-success-ring {
    border-color: #22c55e !important;
}

.swal-success .swal2-success-fix {
    background-color: #22c55e !important;
}

/* Breadcrumb Styles */
.breadcrumb-area {
    background-size: cover;
    background-position: center;
    padding: 100px 0;
    position: relative;
    z-index: 1;
}

.breadcrumb-area::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
}

.breadcrumb-content .title {
    color: #fff;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.breadcrumb .breadcrumb-item a {
    color: #ddd;
    text-decoration: none;
}

.breadcrumb .breadcrumb-item a:hover {
    color: #fff;
}

.breadcrumb .breadcrumb-item.active {
    color: #fff;
}

@media (max-width: 767px) {
    .breadcrumb-content .title {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .breadcrumb-content .title {
        font-size: 1.5rem;
    }
}
</style>
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