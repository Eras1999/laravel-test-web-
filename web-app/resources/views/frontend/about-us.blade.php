@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/about1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">About Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <main>
    <!-- Our Mission Section -->
    <section class="about-section">
        <div class="container">
            
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Our Mission</h2>
                    <p>At Savesathwa, we are driven by a simple yet powerful goal: to create a world where no animal suffers unnoticed or unaided. Through our AI-Powered Animal Rescue and Assistance Platform, we bridge the gap between animals in distress and the compassionate individuals who can help them. By combining cutting-edge technology with community collaboration, we empower users to report, identify, and respond to animal emergencies swiftly and effectively.<br>Our mission is to reduce suffering, save lives, and foster a culture of empathy and action. Whether it’s an injured stray, an abandoned pet, or a snake in need of safe relocation, Savesathwa ensures that every animal receives the care they deserve. Together, we can build a future where technology and human kindness unite to protect the voiceless and create a safer, more compassionate world for all living beings.</p>
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
                    <p>Every day, countless animals face suffering—abandoned on streets, injured in accidents, or struggling to survive in harsh environments. Too often, their cries for help go unheard. Savesathwa was born from a simple question: What if technology could give these voiceless beings a voice?<br><br>Founded by a team of animal lovers and tech innovators, our journey began with a shared vision: to harness the power of artificial intelligence and community action to transform animal rescue. Inspired by real-life stories of animals left helpless due to gaps in existing systems, we set out to build a platform where every report matters, every image can save a life, and every volunteer can make a difference.<br><br>From the first prototype to the AI-powered platform today, Savesathwa has grown into a movement. We’ve witnessed communities rally to rescue snakes, reunite lost pets, and nurse injured strays—all because our platform made it possible. But this is just the beginning.</p>
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
                        <img src="{{ asset('frontend/img/icon/about/community.png') }}" alt="Community">
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
                        <img src="{{ asset('frontend/img/about/partner.jpeg') }}" alt="Partner 1">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partner-logo">
                        <img src="{{ asset('frontend/img/about/volunteer_logo.png') }}" alt="Partner 2">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partner-logo">
                        <img src="{{ asset('frontend/img/about/Rescue-Animals-Logo-NEW-768x768.jpeg') }}" alt="Partner 3">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="partner-logo">
                        <img src="{{ asset('frontend/img/about/WhatsApp Image 2025-06-08 at 11.57.43_d543d219.jpg') }}" alt="Partner 4">
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
                    <a href="{{ route('rescue-posts.index') }}" class="btn">Get Involved</a>
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