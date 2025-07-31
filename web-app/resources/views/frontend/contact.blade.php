@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/cu.jpg') }}">
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
                            <form action="{{ route('contact.submit') }}" method="POST" class="contact-form" id="contact-form">
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
                              
                                <button type="submit" class="btn rounded-btn">Send Now</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-8">
                        <div class="contact-info-wrap">
                            <div class="contact-cards">
                                <div class="contact-card">
                                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="content">
                                        <h4>Location</h4>
                                        <p>5 Sirikurusa Mawatha, Gampaha 11000</p>
                                    </div>
                                </div>
                                <div class="contact-card">
                                    <div class="icon"><i class="fas fa-phone-alt"></i></div>
                                    <div class="content">
                                        <h4>Phone</h4>
                                        <p> 011 1234567</p>
                                    </div>
                                </div>
                                <div class="contact-card">
                                    <div class="icon"><i class="fas fa-envelope-open"></i></div>
                                    <div class="content">
                                        <h4>Email</h4>
                                        <p>SaveSathwa@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-social">
                                <ul>
                                    <li><a href="https://www.facebook.com/profile.php?id=61577191816912"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/save-sathwa/?viewAsMember=true"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

    <!-- map-area -->
    <section class="map-area">
        <div class="container">
            <div class="map-wrap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.279620380752!2d79.99115467551633!3d7.093551816275453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fb92df37e0e7%3A0x75d6d67caa65d4f8!2sREDTECH%20Computers!5e0!3m2!1sen!2slk!4v1753940652881!5m2!1sen!2slk" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- map-area-end -->


@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="{{ asset('frontend/css/rescue-posts-show.css') }}">
<style>

</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="{{ asset('frontend/js/rescue-posts-show.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to submit your message?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#46ac0b',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send it!',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
</script>
@endsection