@extends('frontend.layouts.master')

@section('content')
<main class="snake-catchers-page">
    <section class="snake-catchers-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="snake-catchers-card">
                        <h2 class="section-title">Snake Catchers</h2>

                        <!-- Filtering System -->
                        <div class="filter-section mb-4">
                            <form id="filter-form" method="GET" action="{{ route('snake-catchers.index') }}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="district" class="form-label">Filter by District</label>
                                        <select name="district" id="district" class="form-select">
                                            <option value="">All Districts</option>
                                            @foreach (['Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 'Moneragala', 'Ratnapura', 'Kegalle'] as $district)
                                                <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('snake-catchers.index') }}" class="btn btn-secondary">Reset Filters</a>
                            </form>
                        </div>

                        <!-- Snake Catchers List -->
                        <div class="snake-catchers-grid">
                            @forelse ($snakeCatchers as $catcher)
                                <div class="snake-catcher-item">
                                    <div class="snake-catcher-image-container">
                                        @if ($catcher->image)
                                            <img src="{{ asset('storage/' . $catcher->image) }}" alt="{{ $catcher->name }}" class="snake-catcher-image">
                                        @else
                                            <div class="snake-catcher-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="snake-catcher-content">
                                        <h5 class="snake-catcher-title">{{ $catcher->name }}</h5>
                                        <p class="snake-catcher-meta"><i class="fas fa-map-marker-alt"></i> {{ $catcher->district }}</p>
                                        <p class="snake-catcher-meta"><i class="fas fa-phone"></i> {{ $catcher->mobile_number }}</p>
                                        <p class="snake-catcher-description"><strong>Area Covered:</strong> {{ Str::limit($catcher->description, 100) }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="no-catchers">
                                    <p class="text-muted">No snake catchers available at the moment.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Apply Catcher Form -->
                        <div class="apply-catcher-section mt-5">
                            <h3 class="section-subtitle">Become a Snake Catcher</h3>
                            <button class="btn btn-primary" id="apply-catcher-btn">Apply Catcher</button>
                            <div id="apply-catcher-form" style="display: none;">
                                <form action="{{ route('snake-catchers.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" name="image" id="image" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="district" class="form-label">District</label>
                                            <select name="district" id="district" class="form-select" required>
                                                <option value="">Select District</option>
                                                @foreach (['Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 'Moneragala', 'Ratnapura', 'Kegalle'] as $district)
                                                    <option value="{{ $district }}">{{ $district }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="description" class="form-label">Description <small>(Note: Please specify the area you can cover)</small></label>
                                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="mobile_number" class="form-label">Mobile Number (e.g., 0771234567)</label>
                                            <input type="text" name="mobile_number" id="mobile_number" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="facebook_link" class="form-label">Facebook Link</label>
                                            <input type="url" name="facebook_link" id="facebook_link" class="form-control" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-success">Submit Application</button>
                                            <button type="button" class="btn btn-secondary" id="cancel-apply-btn">Cancel</button>
                                        </div>
                                    </div>
                                </form>
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
<style>
    .snake-catchers-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Poppins', sans-serif;
        padding: 40px 0;
        min-height: 100vh;
    }

    .snake-catchers-section {
        width: 100%;
    }

    .snake-catchers-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .snake-catchers-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        font-size: 2rem;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 30px;
        text-align: center;
    }

    .filter-section {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .filter-section .form-label {
        font-weight: 600;
        color: #333;
    }

    .filter-section .form-select {
        border-radius: 8px;
        padding: 8px;
    }

    .filter-section .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
    }

    .filter-section .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        margin-left: 10px;
    }

    .snake-catchers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .snake-catcher-item {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .snake-catcher-item:hover {
        transform: translateY(-5px);
    }

    .snake-catcher-image-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .snake-catcher-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .snake-catcher-placeholder {
        width: 100%;
        height: 200px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px 10px 0 0;
    }

    .snake-catcher-placeholder i {
        font-size: 2.5rem;
        color: #ccc;
    }

    .snake-catcher-content {
        padding: 20px;
    }

    .snake-catcher-title {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }

    .snake-catcher-meta {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .snake-catcher-meta i {
        margin-right: 8px;
        color: #007bff;
    }

    .snake-catcher-description {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
    }

    .no-catchers {
        grid-column: 1 / -1;
        text-align: center;
        padding: 20px;
    }

    .apply-catcher-section .section-subtitle {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 15px;
    }

    #apply-catcher-form {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        margin-top: 15px;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 1.8rem;
        }

        .col-lg-10 {
            flex: 0 0 90%;
            max-width: 90%;
        }

        .snake-catchers-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    }

    @media (max-width: 767px) {
        .snake-catchers-section {
            padding: 30px 15px;
        }

        .snake-catchers-card {
            padding: 20px;
        }

        .section-title {
            font-size: 1.6rem;
        }

        .snake-catcher-image-container, .snake-catcher-placeholder {
            height: 150px;
        }

        .snake-catcher-title {
            font-size: 1.3rem;
        }

        .snake-catcher-description {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.4rem;
        }

        .snake-catchers-grid {
            grid-template-columns: 1fr;
        }

        .snake-catcher-title {
            font-size: 1.2rem;
        }

        .snake-catcher-meta, .snake-catcher-description {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.getElementById('apply-catcher-btn').addEventListener('click', function() {
        document.getElementById('apply-catcher-form').style.display = 'block';
        this.style.display = 'none';
    });

    document.getElementById('cancel-apply-btn').addEventListener('click', function() {
        document.getElementById('apply-catcher-form').style.display = 'none';
        document.getElementById('apply-catcher-btn').style.display = 'block';
    });
</script>
@endsection