@extends('frontend.layouts.master')

@section('content')

<!-- main-area -->
<main>
<!-- slider-area -->
<section class="slider-area">
    <div class="slider-active owl-carousel">
        @forelse ($sliders as $slider)
            <div class="single-slider slider-bg d-flex align-items-center" data-background="{{ asset('storage/' . $slider->image_link) }}">
                <div class="container custom-container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-10">
                            <div class="slider-content">
                                <div class="slider-title">
                                    <h2 class="title" data-animation="fadeInUpBig" data-delay=".2s" data-duration="1.2s">{{ $slider->top_heading }} <span>{{ $slider->sub_heading }}</span></h2>
                                </div>
                                <div class="slider-desc">
                                    <p class="desc" data-animation="fadeInUpBig" data-delay=".4s" data-duration="1.2s">{{ $slider->content }}</p>
                                </div>
                                @if ($slider->view_more_link)
                                    <a href="{{ $slider->view_more_link }}" class="btn" data-animation="fadeInUpBig" data-delay=".6s" data-duration="1.2s">View More <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                                @else
                                    <a href="#" class="btn" data-animation="fadeInUpBig" data-delay=".6s" data-duration="1.2s">View More <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="single-slider slider-bg d-flex align-items-center" data-background="{{ asset('frontend/img/slider/slider_bg01.jpg') }}">
                <div class="container custom-container">    
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-10">
                            <div class="slider-content">
                                <div class="slider-title">
                                    <h2 class="title" data-animation="fadeInUpBig" data-delay=".2s" data-duration="1.2s">Best Friend <span>with</span> Happy Time</h2>
                                </div>
                                <div class="slider-desc">
                                    <p class="desc" data-animation="fadeInUpBig" data-delay=".4s" data-duration="1.2s">Human Shampoo on Dogs After six days of delirat, the jury found Hernandez guilty of first-degree murder</p>
                                </div>
                                <a href="dog-list.html" class="btn" data-animation="fadeInUpBig" data-delay=".6s" data-duration="1.2s">View More <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <div class="slider-shape"><img src="{{ asset('frontend/img/slider/slider_shape01.png') }}" alt=""></div>
    <div class="slider-shape shape-two"><img src="{{ asset('frontend/img/slider/slider_shape02.png') }}" alt=""></div>
</section>
<!-- slider-area-end -->



<!-- counter-area -->
<section class="counter-area counter-bg" data-background="{{ asset('frontend/img/bg/counter_bg.jpg') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="counter-title text-center mb-65">
                    <h6 class="sub-title">Why Choose Us?</h6>
                    <h2 class="title">Dedicated to Protecting and Rescuing Animals in Need</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="90"></span>%</h2>
                    <p>	Community Reports
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="1000"></span>+</h2>
                    <p>Animals Rescued</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="1"></span>K</h2>
                    <p>Pet Adopted</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="25"></span>+</h2>
                    <p>Active Partners</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- counter-area-end -->

<!-- adoption-area -->
<section class="adoption-area">
    <div class="container">
        <div class="row align-items-center align-items-xl-end justify-content-center">
            <div class="col-xl-7 col-lg-6 col-md-10 order-0 order-lg-2">
                <div class="adoption-img">
                    <img src="{{ asset('frontend/img/images/adoption_img.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="adoption-content">
                    <h2 class="title">Working For <br> Dog <span>Adoption</span> Free, Happy Time</h2>
                    <p>The best overall dog DNA test is Embark Breed & Health Kit (view at Chewy), which provides you with a breed brwn and information.</p>
                    <a href="{{ route('adoption-posts.index') }}" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div class="adoption-shape"><img src="{{ asset('frontend/img/images/adoption_shape.png') }}" alt=""></div>
</section>
<!-- adoption-area-end -->

<!-- breeds-services -->
<section class="breeds-services pt-110 pb-110">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-title text-center mb-65">
                    <div class="section-icon"><img src="{{ asset('frontend/img/icon/pawprint.png') }}" alt=""></div>
                    <h5 class="sub-title">Adoption Cats & Dogs </h5>
                    <h2 class="title">Give Them a Second Chance</h2>
                    <p>Save Sathwa is dedicated to rescuing stray and abandoned animals across Sri Lanka. Through our adoption program, you can give a loving home to a dog or cat in need — because every life deserves love and care.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breed-services-active owl-carousel">
                    <!-- Dog 1 -->
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/sinhala_hound.jpg') }}" alt="Sinhala Hound">
                        </div>
                        <div class="content">
                            <h3 class="title">Sinhala Hound</h3>
                        </div>
                    </div>
                    <!-- Cat 3 -->
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/Orange Sri Lankan Cat.jpg') }}" alt="Orange Sri Lankan Cat">
                        </div>
                        <div class="content">
                            <h3 class="title">Orange Sri Lankan Cat</h3>
                        </div>
                    </div>
                    <!-- Dog 2 -->
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/sri_lankan_ridgeback.jpg') }}" alt="Sri Lankan Ridgeback">
                        </div>
                        <div class="content">
                            <h3 class="title">Sri Lankan Ridgeback</h3>
                        </div>
                    </div>
                    <!-- Cat 1 -->
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/street_cat.jpg') }}" alt="Sri Lankan Street Cat">
                        </div>
                        <div class="content">
                            <h3 class="title">Sri Lankan Street Cat</h3>
                        </div>
                    </div>
                    <!-- Cat 2 -->
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/tabby_cat.jpg') }}" alt="Tabby Cat">
                        </div>
                        <div class="content">
                            <h3 class="title">Local Tabby Cat</h3>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Side Info Box -->
            <div class="col-lg-4 col-md-6">
                <div class="breed-services-info" data-background="{{ asset('frontend/img/bg/breed_services_bg.jpg') }}">
                    <h5 class="sub-title">Adopt a Friend</h5>
                    <h3 class="title">Dogs & Cats Available</h3>
                    <p>Rescued and ready for love — our local dogs and cats are waiting for a second chance. Adopt a life, change a life.</p>
                    <a href="{{ route('adoption-posts.index') }}" class="btn">
                        View All <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breeds-services-end -->

<!-- faq-area -->
<section class="faq-area faq-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="faq-img-wrap">
                    <img src="{{ asset('frontend/img/images/faq_tv.png') }}" class="img-frame" alt="">
                    <img src="{{ asset('frontend/img/images/faq_img.jpg') }}" class="main-img" alt="">
                    <a href="https://www.youtube.com/watch?v=B5A4L7PLuhE" class="popup-video"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-wrapper">
                    <div class="section-title mb-35">
                        <h5 class="sub-title">FAQ Question</h5>
                        <h2 class="title">History & Family Adoption</h2>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How did Save Sathwa begin?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    Save Sathwa was born from a simple act of compassion — rescuing a helpless puppy abandoned near a roadside. Since then, we’ve grown into a community-driven organization dedicated to rescuing, healing, and rehoming stray and injured animals across Sri Lanka. Our name “Sathwa” comes from the Sinhala word for “living being,” because we believe every life deserves care and dignity.                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Can families adopt pets through Save Sathwa?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    Absolutely! We encourage loving families to open their hearts and homes to our rescued animals. Each pet is vaccinated, health-checked, and ready to be part of a caring home. Whether you're a first-time pet parent or looking to add a furry friend to your family, we guide you through every step of the adoption process.                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        How does the animal rescue form work?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Anyone who finds an injured, abandoned, or at-risk animal (dog, cat, bird, snake, or any other animal) can fill out our Rescue Form. You simply select the animal type, describe the situation, upload a clear photo, and share the location. Once submitted, our network of volunteers, organizations, and kind individuals are notified to take action quickly.                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="faq-shape"><img src="{{ asset('frontend/img/images/faq_shape.png') }}" alt=""></div>
</section>
<!-- faq-area-end -->

<!-- brand-area -->
<div class="brand-area pt-80 pb-80">
    <div class="container">
        <div class="row brand-active">
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand1.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand2.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand3.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand4.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand5.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand6.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand3.png') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand-area-end -->

<!-- adoption-shop-area -->
<section class="rescue-highlight-area pb-100">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-xl-8 col-lg-10 text-center">
                <div class="section-title position-relative">
                    <div class="section-icon mb-4 d-inline-flex align-items-center justify-content-center">
                        <div class="icon-wrapper">
                            <img src="frontend/img/icon/pawprint.png" alt="Paw Icon" class="paw-icon">
                        </div>
                    </div>
                    <h5 class="sub-title text-uppercase fw-bold mb-3">Real-Time Rescues</h5>
                    <h2 class="title">Animals That Need You</h2>
                    <p class="description lead text-muted mb-5">These are real cases submitted by kind-hearted people. Injured, lost, or abandoned — every one of them needs a helping hand.</p>
                </div>
            </div>
        </div>

       <!-- Animal Categories -->
<div class="row justify-content-center mb-5">
    <div class="col-lg-10">
        <div class="animal-categories">
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="animal-card text-center">
                        <div class="animal-icon mb-3">
                            <i class="fas fa-dog"></i>
                        </div>
                        <h6 class="animal-name">Dogs</h6>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="animal-card text-center">
                        <div class="animal-icon mb-3">
                            <i class="fas fa-cat"></i>
                        </div>
                        <h6 class="animal-name">Cats</h6>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="animal-card text-center">
                        <div class="animal-icon mb-3">
                            <i class="fas fa-dove"></i>
                        </div>
                        <h6 class="animal-name">Birds</h6>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="animal-card text-center">
                        <div class="animal-icon mb-3">
                            <i class="fas fa-dragon"></i>
                        </div>
                        <h6 class="animal-name">Snakes</h6>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="animal-card text-center">
                        <div class="animal-icon mb-3">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h6 class="animal-name">Others</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Action Buttons -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="rescue-actions d-flex flex-wrap justify-content-center gap-4">
                    <a href="{{ route('rescue-posts.index') }}" class="btn btn-primary btn-lg rescue-btn">
                        <i class="fas fa-search me-2"></i>
                        View All Rescues posts
                    </a>                   
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="rescue-stats">
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card text-center">
                                <div class="stat-number">254</div>
                                <div class="stat-label">Animals Rescued</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card text-center">
                                <div class="stat-number">89</div>
                                <div class="stat-label">Active Cases</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card text-center">
                                <div class="stat-number">1.2K</div>
                                <div class="stat-label">Community Members</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card text-center">
                                <div class="stat-number">156</div>
                                <div class="stat-label">Success Stories</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- adoption-shop-area-end -->



<!-- rescue-highlight-area -->
<!-- Snake Catcher Banner Section -->
<section class="snake-catcher-section">
    <img src="{{ asset('frontend/img/snake_catcher/banner.jpg') }}" alt="Snake Catcher Banner" class="img-fluid w-100" style="max-height: 550px; object-fit: cover;">
</section>

<!-- Snake Catcher Call-to-Action -->
<section class="snake-catcher-cta py-5 text-center bg-light">
    <div class="container">
        <h2 class="fw-bold mb-3">Need a Snake Catcher?</h2>
        <p class="mb-4">If you encounter a snake, don’t panic. Our trained rescue team is just a click away to handle it safely and humanely.</p>
        <a href="{{ route('snake-catchers.index') }}" class="btn btn-primary btn-lg">
            Contact Snake Catcher
            <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt="icon" style="width: 18px; margin-left: 6px;">
        </a>
    </div>
</section>


<!-- rescue-highlight-area-end -->

<!-- testimonial-area -->
<section class="testimonial-area testimonial-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-title text-center mb-65">
                    <div class="section-icon"><img src="{{ asset('frontend/img/icon/pawprint.png') }}" alt=""></div>
                    <h5 class="sub-title">Testimonials</h5>
                    <h2 class="title">Our Happy Customers</h2>
                    <p>The best overall dog DNA test is Embark Breed & Health Kit (view at Chewy), which provides you with a
                        breed brwn and information Most dogs</p>
                </div>
            </div>
        </div>
        <div class="row testimonial-active">
            @forelse ($testimonials as $testimonial)
                <div class="col-lg-6">
                    <div class="testimonial-item">
                        <div class="testi-avatar-thumb">
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                        </div>
                        <div class="testi-content">
                            <p>“ {{ $testimonial->description }} ”</p>
                            <div class="testi-avatar-info">
                                <h5 class="title">{{ $testimonial->name }}</h5>
                                <span>{{ $testimonial->profession }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-6">
                    <div class="testimonial-item">
                        <div class="testi-avatar-thumb">
                            <img src="{{ asset('frontend/img/images/testi_avatar01.png') }}" alt="Default Testimonial">
                        </div>
                        <div class="testi-content">
                            <p>“ No testimonials available yet. ”</p>
                            <div class="testi-avatar-info">
                                <h5 class="title">Default User</h5>
                                <span>Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- testimonial-area-end -->

<!-- Latest News -->
<section class="blog-area pt-110 pb-60" id="latest-news">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-title text-center mb-65">
                    <div class="section-icon"><img src="{{ asset('frontend/img/icon/pawprint.png') }}" alt=""></div>
                    <h5 class="sub-title">Our News</h5>
                    <h2 class="title">Latest News Update</h2>
                    <p>The best overall dog DNA test is Embark Breed & Health Kit (view at Chewy), which provides you with a
                        breed brwn and information Most dogs</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @forelse ($news as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="blog-post-item mb-50">
                        <div class="blog-post-thumb">
                            <a href="#"><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 100%; height: auto; max-height: 200px; object-fit: cover;"></a>
                            <div class="blog-post-tag">
                                <a href="#"><i class="flaticon-bookmark-1"></i>News</a>
                            </div>
                        </div>
                        <div class="blog-post-content">
                            <div class="blog-post-meta">
                                <ul>
                                    <li><i class="far fa-user"></i><a href="#">Admin</a></li>
                                    <li><i class="far fa-bell"></i> {{ $item->date->format('M d, Y') }}</li>
                                </ul>
                            </div>
                            <h3 class="title"><a href="#">{{ $item->title }}</a></h3>
                            <p class="text-truncate">{{ $item->content }}</p>
                            <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#newsModal{{ $item->id }}">Read More <img src="{{ asset('frontend/img/icon/pawprint.png') }}" alt=""></a>
                        </div>
                    </div>
                </div>

                <!-- News Modal -->
                <div class="modal fade" id="newsModal{{ $item->id }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newsModalLabel{{ $item->id }}">{{ $item->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-fluid mb-3">
                                <p><strong>Date:</strong> {{ $item->date->format('M d, Y') }}</p>
                                <p>{{ $item->content }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No news items available yet.</p>
                </div>
            @endforelse
        </div>
        <!-- Pagination -->
        <div class="row justify-content-center">
            <div class="col-12">
                {{ $news->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
<!-- Latest News-end -->



</main>
<!-- main-area-end -->

@endsection

@section('styles')
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />


@endsection

@section('scripts')
<!-- jQuery (required for Owl Carousel) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<!-- Bootstrap 5 JS for Modal (already included, keeping for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Owl Carousel
        try {
            if ($('.slider-active').length) {
                $('.slider-active').trigger('destroy.owl.carousel');
                $('.slider-active').owlCarousel({
                    loop: true,
                    margin: 0,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: false,
                    items: 1,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    smartSpeed: 1000,
                    onInitialized: function() {
                        console.log('Owl Carousel initialized');
                    },
                    onTranslate: function() {
                        console.log('Slide transition started');
                    }
                });
                $('.slider-active').trigger('refresh.owl.carousel');
            } else {
                console.error('Slider element (.slider-active) not found');
            }
        } catch (error) {
            console.error('Error initializing Owl Carousel:', error);
        }

        // Scroll to Latest News section if the URL has #latest-news
        if (window.location.hash === '#latest-news') {
            setTimeout(function() {
                $('html, body').scrollTop($('#latest-news').offset().top - 50); // Adjust offset for better visibility
            }, 100); // Small delay to ensure the page has loaded
        }

        // Handle pagination link clicks to append #latest-news and prevent default behavior
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            // Append #latest-news to the URL and navigate
            window.location.href = url + '#latest-news';
        });
    });

    
</script>
@endsection