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

<!-- find-area -->
<div class="find-area">
    <div class="container custom-container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="find-wrap">
                        <div class="location">
                            <i class="flaticon-location"></i>
                            <input type="text" value="Enter City, State. or Zip">
                        </div>
                        <div class="find-category">
                            <ul>
                                <li><a href="shop.html"><i class="flaticon-dog"></i> Find Your Dog</a></li>
                                <li><a href="shop.html"><i class="flaticon-happy"></i> Find Your Cat</a></li>
                                <li><a href="shop.html"><i class="flaticon-dove"></i> Find Your Birds</a></li>
                            </ul>
                        </div>
                        <div class="other-find">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Find Other Pets
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="shop.html">Find Your Dog</a>
                                    <a class="dropdown-item" href="shop.html">Find Your Cat</a>
                                    <a class="dropdown-item" href="shop.html">Find Your Birds</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- find-area-end -->

<!-- counter-area -->
<section class="counter-area counter-bg" data-background="{{ asset('frontend/img/bg/counter_bg.jpg') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="counter-title text-center mb-65">
                    <h6 class="sub-title">Why Choose Us?</h6>
                    <h2 class="title">Best Service to Breeds Your Loved Dog Explore</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="73"></span>%</h2>
                    <p>dogs are first bred</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="259"></span>+</h2>
                    <p>Most dogs are first</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="39"></span>K</h2>
                    <p>Dog Breeding</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="counter-item">
                    <h2 class="count"><span class="odometer" data-count="45"></span>+</h2>
                    <p>Years Of History</p>
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
                    <a href="adoption.html" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
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
                    <h5 class="sub-title">Service to Breeds</h5>
                    <h2 class="title">Most Popular Dog Breed</h2>
                    <p>The best overall dog DNA test is Embark Breed & Health Kit (view at Chewy), which provides you with a breed brwn and information Most dogs</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breed-services-active owl-carousel">
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/breed_services_img01.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <h3 class="title"><a href="breeder-details.html">Golden Retriever</a></h3>
                        </div>
                    </div>
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/breed_services_img02.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <h3 class="title"><a href="breeder-details.html">German Sharped</a></h3>
                        </div>
                    </div>
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/breed_services_img03.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <h3 class="title"><a href="breeder-details.html">Siberian Husky</a></h3>
                        </div>
                    </div>
                    <div class="breed-services-item">
                        <div class="thumb">
                            <img src="{{ asset('frontend/img/images/breed_services_img04.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <h3 class="title"><a href="breeder-details.html">Bernes Mountain</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="breed-services-info" data-background="{{ asset('frontend/img/bg/breed_services_bg.jpg') }}">
                    <h5 class="sub-title">Dog Breeder</h5>
                    <h3 class="title">Available for Breed</h3>
                    <p>The best overall dog DNA test is Embark Breed & Health Kit (view at Chewy), which provid dogs</p>
                    <a href="dog-list.html" class="btn">More Pets <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div class="breed-services-shape"><img src="{{ asset('frontend/img/images/breed_services_shape01.png') }}" alt=""></div>
    <div class="breed-services-shape shape-two"><img src="{{ asset('frontend/img/images/breed_services_shape02.png') }}" alt=""></div>
</section>
<!-- breeds-services-end -->

<!-- faq-area -->
<section class="faq-area faq-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="faq-img-wrap">
                    <img src="{{ asset('frontend/img/images/faq_tv.png') }}" class="img-frame" alt="">
                    <img src="{{ asset('frontend/img/images/faq_img.png') }}" class="main-img" alt="">
                    <a href="https://www.youtube.com/watch?v=XdFfCPK5ycw" class="popup-video"></a>
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
                                        Working for dog adoption
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    The best overall dog DNA test is embark breed & health Kit (view atths Chewy), which provides you with a breed brwn and ition on provides ancestors most dogs.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Competitions & Awards
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    The best overall dog DNA test is embark breed & health Kit (view atths Chewy), which provides you with a breed brwn and ition on provides ancestors most dogs.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        The puppies are 3 months old
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    The best overall dog DNA test is embark breed & health Kit (view atths Chewy), which provides you with a breed brwn and ition on provides ancestors most dogs.
                                </div>
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
                    <img src="{{ asset('frontend/img/brand/brand_item01.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand_item02.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand_item03.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand_item04.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand_item05.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand_item06.png') }}" alt="img">
                </div>
            </div>
            <div class="col-12">
                <div class="brand-item">
                    <img src="{{ asset('frontend/img/brand/brand_item03.png') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand-area-end -->

<!-- adoption-shop-area -->
<section class="adoption-shop-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="section-title text-center mb-65">
                    <div class="section-icon"><img src="{{ asset('frontend/img/icon/pawprint.png') }}" alt=""></div>
                    <h5 class="sub-title">Meet the animals</h5>
                    <h2 class="title">Puppies Waiting for Adoption</h2>
                    <p>The best overall dog DNA test is Embark Breed & Health Kit (view at Chewy), which provides you with a
                        breed brwn and information Most dogs</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="adoption-shop-item">
                    <div class="adoption-shop-thumb">
                        <img src="{{ asset('frontend/img/product/adoption_shop_thumb01.jpg') }}" alt="">
                        <a href="shop-details.html" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                    </div>
                    <div class="adoption-shop-content">
                        <h4 class="title"><a href="shop-details.html">Mister Tartosh</a></h4>
                        <div class="adoption-meta">
                            <ul>
                                <li><i class="fas fa-cog"></i><a href="#">Siberian Husky</a></li>
                                <li><i class="far fa-calendar-alt"></i> Birth : 2021</li>
                            </ul>
                        </div>
                        <div class="adoption-rating">
                            <ul>
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li class="price">Total Price : <span>Free</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="adoption-shop-item">
                    <div class="adoption-shop-thumb">
                        <img src="{{ asset('frontend/img/product/adoption_shop_thumb02.jpg') }}" alt="">
                        <a href="shop-details.html" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                    </div>
                    <div class="adoption-shop-content">
                        <h4 class="title"><a href="shop-details.html">Charlie</a></h4>
                        <div class="adoption-meta">
                            <ul>
                                <li><i class="fas fa-cog"></i><a href="#">Golden Retriever</a></li>
                                <li><i class="far fa-calendar-alt"></i> Birth : 2020</li>
                            </ul>
                        </div>
                        <div class="adoption-rating">
                            <ul>
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li class="price">Total Price : <span>$30</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="adoption-shop-item">
                    <div class="adoption-shop-thumb">
                        <img src="{{ asset('frontend/img/product/adoption_shop_thumb03.jpg') }}" alt="">
                        <a href="shop-details.html" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                    </div>
                    <div class="adoption-shop-content">
                        <h4 class="title"><a href="shop-details.html">Alessia Max</a></h4>
                        <div class="adoption-meta">
                            <ul>
                                <li><i class="fas fa-cog"></i><a href="#">German Sherped</a></li>
                                <li><i class="far fa-calendar-alt"></i> Birth : 2020</li>
                            </ul>
                        </div>
                        <div class="adoption-rating">
                            <ul>
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li class="price">Total Price : <span>$29</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="adoption-shop-item">
                    <div class="adoption-shop-thumb">
                        <img src="{{ asset('frontend/img/product/adoption_shop_thumb04.jpg') }}" alt="">
                        <a href="shop-details.html" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                    </div>
                    <div class="adoption-shop-content">
                        <h4 class="title"><a href="shop-details.html">Canadian</a></h4>
                        <div class="adoption-meta">
                            <ul>
                                <li><i class="fas fa-cog"></i><a href="#">German Sherped</a></li>
                                <li><i class="far fa-calendar-alt"></i> Birth : 2021</li>
                            </ul>
                        </div>
                        <div class="adoption-rating">
                            <ul>
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li class="price">Total Price : <span>$39</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="adoption-shop-item">
                    <div class="adoption-shop-thumb">
                        <img src="{{ asset('frontend/img/product/adoption_shop_thumb05.jpg') }}" alt="">
                        <a href="shop-details.html" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                    </div>
                    <div class="adoption-shop-content">
                        <h4 class="title"><a href="shop-details.html">Entertainment</a></h4>
                        <div class="adoption-meta">
                            <ul>
                                <li><i class="fas fa-cog"></i><a href="#">Siberian Husky</a></li>
                                <li><i class="far fa-calendar-alt"></i> Birth : 2021</li>
                            </ul>
                        </div>
                        <div class="adoption-rating">
                            <ul>
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li class="price">Total Price : <span>Free</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="adoption-shop-item">
                    <div class="adoption-shop-thumb">
                        <img src="{{ asset('frontend/img/product/adoption_shop_thumb06.jpg') }}" alt="">
                        <a href="shop-details.html" class="btn">Adoption <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt=""></a>
                    </div>
                    <div class="adoption-shop-content">
                        <h4 class="title"><a href="shop-details.html">Dangerous</a></h4>
                        <div class="adoption-meta">
                            <ul>
                                <li><i class="fas fa-cog"></i><a href="#">Golden Retriever</a></li>
                                <li><i class="far fa-calendar-alt"></i> Birth : 2021</li>
                            </ul>
                        </div>
                        <div class="adoption-rating">
                            <ul>
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </li>
                                <li class="price">Total Price : <span>Free</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- adoption-shop-area-end -->

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

<!-- newsletter-area -->
<div class="newsletter-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="newsletter-wrap">
                    <div class="newsletter-content">
                        <h2 class="title">Newsletter For</h2>
                        <p><span>*</span> Do Not Show Your Email.</p>
                    </div>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="Enter Your Email...">
                            <button type="submit" class="btn">Subscribe</button>
                        </form>
                    </div>
                    <div class="newsletter-shape"><img src="{{ asset('frontend/img/images/newsletter_shape01.png') }}" alt=""></div>
                    <div class="newsletter-shape shape-two"><img src="{{ asset('frontend/img/images/newsletter_shape02.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- newsletter-area-end -->
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