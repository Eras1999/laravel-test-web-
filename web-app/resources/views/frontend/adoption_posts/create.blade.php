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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    .modern-adoption-page {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    /* Hero Banner */
    .hero-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 90vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="rgba(255,255,255,.1)"/><stop offset="100%" stop-color="rgba(255,255,255,0)"/></radialGradient></defs><circle fill="url(%23a)" cx="10" cy="10" r="8"/><circle fill="url(%23a)" cx="80" cy="5" r="5"/><circle fill="url(%23a)" cx="60" cy="15" r="6"/></svg>') repeat;
        opacity: 0.3;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .gradient-text {
        background: linear-gradient(45deg, #46ac0b, #7ed321);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 3rem;
        font-weight: 300;
    }

    .hero-stats {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;
        margin-top: 2rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #46ac0b;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-divider {
        width: 1px;
        height: 40px;
        background: rgba(255, 255, 255, 0.3);
    }

    /* Floating Elements */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
    }

    .floating-paw, .floating-heart {
        position: absolute;
        font-size: 2rem;
        opacity: 0.6;
        animation: float 6s ease-in-out infinite;
    }

    .paw-1 { top: 20%; left: 10%; animation-delay: 0s; }
    .paw-2 { top: 60%; right: 15%; animation-delay: 2s; }
    .paw-3 { bottom: 30%; left: 20%; animation-delay: 4s; }
    .heart-1 { top: 40%; right: 10%; animation-delay: 1s; }
    .heart-2 { bottom: 20%; right: 30%; animation-delay: 3s; }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    /* How It Works Section */
    .how-it-works {
        padding: 100px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 3rem;
    }

    .step-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .step-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(45deg, #46ac0b, #7ed321);
    }

    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .step-icon {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    .step-icon i {
        font-size: 3rem;
        color: #46ac0b;
        margin-bottom: 1rem;
    }

    .step-number {
        position: absolute;
        top: -10px;
        right: -10px;
        background: linear-gradient(45deg, #46ac0b, #7ed321);
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .step-card h4 {
        font-size: 1.4rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
    }

    .step-card p {
        color: #666;
        line-height: 1.6;
    }

    /* Create Post Banner */
    .create-post-banner {
        padding: 100px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
    }

    .create-post-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 30px;
        padding: 4rem 3rem;
        text-align: center;
        backdrop-filter: blur(20px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .card-decoration {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
    }

    .decoration-circle {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(45deg, #46ac0b, #7ed321);
        opacity: 0.1;
    }

    .circle-1 {
        width: 150px;
        height: 150px;
        top: -75px;
        right: -75px;
    }

    .circle-2 {
        width: 100px;
        height: 100px;
        bottom: -50px;
        left: -50px;
    }

    .circle-3 {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
    }

    .card-content {
        position: relative;
        z-index: 2;
    }

    .icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #46ac0b, #7ed321);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        box-shadow: 0 10px 30px rgba(70, 172, 11, 0.3);
    }

    .icon-wrapper i {
        font-size: 2rem;
        color: white;
    }

    .card-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1.5rem;
    }

    .card-description {
        font-size: 1.1rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 2.5rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-secondary {
        padding: 15px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(45deg, #46ac0b, #7ed321);
        color: white;
        box-shadow: 0 5px 15px rgba(70, 172, 11, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(70, 172, 11, 0.4);
        color: white;
    }

    .btn-secondary {
        background: transparent;
        color: #333;
        border: 2px solid #ddd;
    }

    .btn-secondary:hover {
        background: #333;
        color: white;
        border-color: #333;
    }

    /* Tips Section */
    .tips-section {
        padding: 100px 0;
        background: #f8f9fa;
    }

    .tip-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
        margin-bottom: 1rem;
    }

    .tip-card:hover {
        transform: translateX(10px);
    }

    .tip-icon {
        font-size: 2.5rem;
        flex-shrink: 0;
    }

    .tip-content h5 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .tip-content p {
        color: #666;
        margin: 0;
        line-height: 1.6;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .hero-title {
            font-size: 3rem;
        }
    }

    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-stats {
            flex-direction: column;
            gap: 1rem;
        }
        
        .stat-divider {
            width: 40px;
            height: 1px;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
    }

    @media (max-width: 768px) {
        .hero-banner {
            min-height: 70vh;
            padding: 2rem 0;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .create-post-card {
            padding: 2.5rem 1.5rem;
        }
        
        .card-title {
            font-size: 1.8rem;
        }
        
        .tip-card {
            flex-direction: column;
            text-align: center;
        }
        
        .tip-card:hover {
            transform: translateY(-5px);
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.8rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .step-card {
            padding: 2rem 1.5rem;
        }
        
        .create-post-card {
            padding: 2rem 1rem;
        }
        
        .floating-paw, .floating-heart {
            display: none;
        }
    }
</style>
@endsection