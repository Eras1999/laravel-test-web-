@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/dog_ai_bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Dog Breed AI Identification</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dog Breed AI</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <main class="dog-ai-page">
        <section class="dog-ai-section py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="snake-ai-card">
                            <div class="header-section mb-4">
                                <h2>
                                    <i class="fas fa-dog"></i> Dog Breed AI Identification
                                </h2>
                                <p>
                                    Instantly identify dog breeds with the help of artificial intelligence. Upload a clear photo of a dog, and our tool will tell you its breed with high accuracy.
                                </p>
                            </div>

                            <div class="snake-ai-content mb-5">
                                <p>
                                    This AI-powered tool is trained on thousands of images to recognize 10 popular dog breeds, including German Shepherd, Labrador Retriever, Beagle, Poodle, and more. It helps pet lovers, shelters, and rescuers understand dog types better.
                                </p>
                                <a href="https://eras1999.github.io/AI_Dog_Breed/" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Check Dog Breed
                                </a>
                            </div>

                            <div class="instruction-section">
                                <h4>
                                    <i class="fas fa-info-circle"></i> How to Use Dog Breed AI
                                </h4>
                                <ul>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>Click the Button:</strong> Use the "Check Dog Breed" button above to open the AI tool.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>Upload a Photo:</strong> Upload a clear image of the dog you want to identify.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>View the Results:</strong> The AI will predict the dog breed and show you the confidence percentage.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <strong>Learn More:</strong> Use the breed result to learn more about your dog’s characteristics and care needs.
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
