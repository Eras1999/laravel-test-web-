@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/create_adopt.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Adoption Post</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Adoption Post</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <main class="modern-adoption-page">
        <!-- Hero Banner -->
        <section class="hero-banner">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-10">
                            <div class="hero-text">
                                <h1 class="hero-title">
                                    <span class="gradient-text">Save a Life</span>
                                    <br>Create an Adoption Post
                                </h1>
                                <p class="hero-subtitle">
                                    Every pet deserves a loving home. Your post could be the bridge between a pet in need and their perfect family.
                                </p>
                                <div class="hero-stats">
                                    <div class="stat-item">
                                        <div class="stat-number">1,200+</div>
                                        <div class="stat-label">Pets Adopted</div>
                                    </div>
                                    <div class="stat-divider"></div>
                                    <div class="stat-item">
                                        <div class="stat-number">98%</div>
                                        <div class="stat-label">Success Rate</div>
                                    </div>
                                    <div class="stat-divider"></div>
                                    <div class="stat-item">
                                        <div class="stat-number">500+</div>
                                        <div class="stat-label">Happy Families</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="floating-elements">
                <div class="floating-paw paw-1">🐾</div>
                <div class="floating-paw paw-2">🐾</div>
                <div class="floating-paw paw-3">🐾</div>
                <div class="floating-heart heart-1">💖</div>
                <div class="floating-heart heart-2">💖</div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="section-title">How It Works</h2>
                        <p class="section-subtitle">Simple steps to help a pet find their forever home</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="step-card">
                            <div class="step-icon">
                                <i class="fas fa-camera"></i>
                                <div class="step-number">1</div>
                            </div>
                            <h4>Upload Photos</h4>
                            <p>Share beautiful photos of the pet to attract potential adopters</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="step-card">
                            <div class="step-icon">
                                <i class="fas fa-edit"></i>
                                <div class="step-number">2</div>
                            </div>
                            <h4>Add Details</h4>
                            <p>Provide important information about the pet's personality and needs</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="step-card">
                            <div class="step-icon">
                                <i class="fas fa-heart"></i>
                                <div class="step-number">3</div>
                            </div>
                            <h4>Find Love</h4>
                            <p>Connect with loving families ready to welcome a new member</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Create Post Banner -->
        <section class="create-post-banner">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="create-post-card">
                            <div class="card-decoration">
                                <div class="decoration-circle circle-1"></div>
                                <div class="decoration-circle circle-2"></div>
                                <div class="decoration-circle circle-3"></div>
                            </div>
                            <div class="card-content">
                                <div class="icon-wrapper">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <h3 class="card-title">Ready to Make a Difference?</h3>
                                <p class="card-description">
                                    Create your adoption post now and help connect a pet with their perfect family. 
                                    It only takes a few minutes to potentially change a life forever.
                                </p>
                                <div class="action-buttons">
                                    <a href="{{ route('adoption-posts.form') }}" class="btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Create Adoption Post
                                    </a>
                                    <a href="#tips" class="btn-secondary">
                                        <i class="fas fa-lightbulb"></i>
                                        View Tips
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tips Section -->
        <section class="tips-section" id="tips">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="section-title">Tips for a Great Post</h2>
                        <p class="section-subtitle">Make your adoption post stand out</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="tip-card">
                            <div class="tip-icon">📸</div>
                            <div class="tip-content">
                                <h5>High-Quality Photos</h5>
                                <p>Use clear, well-lit photos that show the pet's personality. Multiple angles help!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="tip-card">
                            <div class="tip-icon">📝</div>
                            <div class="tip-content">
                                <h5>Detailed Description</h5>
                                <p>Include the pet's age, temperament, medical history, and special needs.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="tip-card">
                            <div class="tip-icon">💝</div>
                            <div class="tip-content">
                                <h5>Share Their Story</h5>
                                <p>Tell potential adopters about the pet's background and what makes them special.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="tip-card">
                            <div class="tip-icon">🏠</div>
                            <div class="tip-content">
                                <h5>Ideal Home</h5>
                                <p>Describe what type of home environment would be perfect for this pet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/adoption_create.css') }}">

@endsection