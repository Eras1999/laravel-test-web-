@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/snake_ai2.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Snake AI Identification</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Snake AI</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <main class="snake-ai-page">
        <section class="snake-ai-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="snake-ai-card">
                            <div class="header-section">
                                <h2>
                                    <i class="fas fa-snake"></i> Snake AI Identification
                                </h2>
                                <p>
                                    Identify snakes quickly and safely with our AI-powered tool. Upload an image and get instant results to help protect both humans and snakes.
                                </p>
                            </div>

                            <div class="snake-ai-content">
                                <p>
                                    Our advanced AI technology analyzes snake images to provide accurate identification, helping you understand whether a snake is venomous or non-venomous. This tool is designed to promote safety and conservation by enabling quick and informed decisions.
                                </p>
                                <a href="https://eras1999.github.io/Save_Sathwa_AI_Snake_Detection/" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Check Snake ID
                                </a>
                            </div>

                            <div class="instruction-section">
                                <h4>
                                    <i class="fas fa-info-circle"></i> How to Use Snake AI
                                </h4>
                                <ul>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>Click the Button:</strong> Use the "Check Snake ID" button to access our AI tool.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>Upload an Image:</strong> On the AI tool page, upload a clear image of the snake.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>Get Results:</strong> The AI will analyze the image and provide identification details instantly.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>Stay Safe:</strong> Use the results to make informed decisions about handling or reporting the snake.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('frontend/css/snake-ai.css') }}">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
@endsection