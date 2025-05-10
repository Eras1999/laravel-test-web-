@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/breadcrumb_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Contact Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- contact-area -->
    <section class="contact-area pt-110 pb-110">
        <div class="container">
            <div class="container-inner-wrap">
                <div class="row justify-content-center justify-content-lg-between">
                    <div class="col-lg-6 col-md-8 order-2 order-lg-0">
                        <div class="contact-title mb-20">
                            <h5 class="sub-title">Contact Us</h5>
                            <h2 class="title">Let's Talk Question<span>.</span></h2>
                        </div>
                        <div class="contact-wrap-content">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                                @csrf
                                <div class="form-grp">
                                    <label for="name">Your Name <span>*</span></label>
                                    <input type="text" id="name" name="name" placeholder="Jon Deo..." value="{{ old('name') }}" class="form-control">
                                </div>
                                <div class="form-grp">
                                    <label for="email">Your Email <span>*</span></label>
                                    <input type="text" id="email" name="email" placeholder="info.example@.com" value="{{ old('email') }}" class="form-control">
                                </div>
                                <div class="form-grp">
                                    <label for="message">Your Message <span>*</span></label>
                                    <textarea name="message" id="message" placeholder="Opinion..." class="form-control">{{ old('message') }}</textarea>
                                </div>
                                <div class="form-grp checkbox-grp">
                                    <input type="checkbox" id="checkbox" name="hide_email">
                                    <label for="checkbox">Don’t show your email address</label>
                                </div>
                                <button type="submit" class="btn rounded-btn">Send Now</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-8">
                        <div class="contact-info-wrap">
                            <div class="contact-img">
                                <img src="{{ asset('frontend/img/images/contact_img.png') }}" alt="">
                            </div>
                            <div class="contact-info-list">
                                <ul>
                                    <li>
                                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                        <div class="content">
                                            <p>W84 New Park Lan, New York, NY 4586 United States</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                        <div class="content">
                                            <p>+9 (256) 254 9568</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fas fa-envelope-open"></i></div>
                                        <div class="content">
                                            <p>Contact@ info.com</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-social">
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

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
@endsection