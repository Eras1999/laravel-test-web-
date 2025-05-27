@extends('frontend.layouts.master')
@section('title', 'About Us - SaveSathwa')
@section('content')
<main>
    <!-- Hero Section with Image and Title -->
    <section class="about-hero">
        <div class="about-hero-image">
            <img src="{{ asset('frontend/img/about/about-hero.webp') }}" alt="About Us">
            <div class="about-hero-overlay">
                <div class="hero-content">
                    <h1 class="hero-title">About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Our Mission</h2>
                    <p>At SaveSathwa, our mission is to rescue, rehabilitate, and rehome animals in need, ensuring they find loving families and a safe haven.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section with Image -->
    <section class="about-section about-story">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('frontend/img/about/our-story.webp') }}" alt="Our Story" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <h2>Our Story</h2>
                    <p>Founded in 2020, SaveSathwa began as a small group of animal lovers in Colombo, Sri Lanka. Today, we’ve grown into a community-driven platform, having rescued over 5,000 animals and facilitated countless adoptions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section with Cards -->
    <section class="about-section why-choose-us">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Why Choose Us?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="about-card">
                        <img src="{{ asset('frontend/img/icon/about/partner1.png') }}" alt="Compassion">
                        <h3>Compassion</h3>
                        <p>We treat every animal with the care and love they deserve, ensuring their well-being is our top priority.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-card">
                        <img src="{{ asset('frontend/img/icon/about/transparency.png') }}" alt="Transparency">
                        <h3>Transparency</h3>
                        <p>We maintain open communication with adopters and donors, providing updates on every step of the process.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-card">
                        <img src="{{ asset('frontend/img/icon/about/community.jpg') }}" alt="Community">
                        <h3>Community</h3>
                        <p>We foster a supportive community of animal lovers, encouraging involvement through events and volunteering.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features Section with Slider -->
    <section class="about-section key-features">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Key Features</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="features-slider">
                        <div class="feature-slide">
                            <img src="{{ asset('frontend/img/about/feature-adoption.jpg') }}" alt="Adoption">
                            <h3>Streamlined Adoption</h3>
                            <p>Our user-friendly platform makes finding and adopting a pet easier than ever.</p>
                        </div>
                        <div class="feature-slide">
                            <img src="{{ asset('frontend/img/about/feature-education.jpg') }}" alt="Education">
                            <h3>Education Resources</h3>
                            <p>Access guides and workshops to learn about responsible pet ownership.</p>
                        </div>
                        <div class="feature-slide">
                            <img src="{{ asset('frontend/img/about/feature-support.jpg') }}" alt="Support">
                            <h3>24/7 Support</h3>
                            <p>Our team is available around the clock to assist with any queries.</p>
                        </div>
                        <div class="feature-slide">
                            <img src="{{ asset('frontend/img/about/feature-education.jpg') }}" alt="Education">
                            <h3>Education Resources</h3>
                            <p>Access guides and workshops to learn about responsible pet ownership.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Partnerships Section -->
    <section class="about-section our-partnerships">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Our Partnerships</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="partner-logo">
                        <img src="{{ asset('frontend/img/about/partner1.png') }}" alt="Partner 1">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partner-logo">
                        <img src="{{ asset('frontend/img/about/partner1.png') }}" alt="Partner 2">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partner-logo">
                        <img src="{{ asset('frontend/img/about/partner1.png') }}" alt="Partner 3">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partner-logo">
                        <img src="{{ asset('frontend/img/about/partner1.png') }}" alt="Partner 4">
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Our Impact Section -->
    <section class="about-section our-impact">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Our Impact</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="impact-stat">
                        <h3>5,000+</h3>
                        <p>Animals Rescued</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="impact-stat">
                        <h3>3,000+</h3>
                        <p>Successful Adoptions</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="impact-stat">
                        <h3>10,000+</h3>
                        <p>Community Members</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="about-section cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Join Our Mission</h2>
                    <p>Be a part of our journey to save more animals. Adopt, donate, or volunteer today!</p>
                    <a href="adoption.html" class="btn">Get Involved</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/about-us.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="{{ asset('frontend/js/about-us.js') }}"></script>