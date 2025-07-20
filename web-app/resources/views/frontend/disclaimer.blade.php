@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/disclaimer-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Disclaimer</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Disclaimer</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <main class="disclaimer-page" style="background: #f7fafc; padding: 50px 0; font-family: 'Poppins', sans-serif;">
        <section class="disclaimer-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="disclaimer-card" style="background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                            <h2 style="font-size: 2rem; color: #2d3748; font-weight: 700; margin-bottom: 20px;">Important Disclaimer</h2>
                            <p style="font-size: 1.1rem; color: #4a5568; line-height: 1.6; margin-bottom: 15px;">
                                The information and tools provided by Save Sathwa, including the AI Snake Identification feature, are intended for educational and informational purposes only. They are not a substitute for professional advice or emergency services.
                            </p>
                            <ul style="list-style: none; padding: 0; margin-bottom: 15px;">
                                <li style="margin-bottom: 10px;"><strong>AI Limitations:</strong> The AI Snake Identification tool provides an automated analysis based on image data. While designed to be accurate, it may not always correctly identify snake species or venomous status. Always consult a local expert or wildlife professional for confirmation.</li>
                                <li style="margin-bottom: 10px;"><strong>User Responsibility:</strong> Users are solely responsible for their actions when interacting with animals, including handling, reporting, or relocating snakes. Save Sathwa does not endorse or guarantee the safety of such actions.</li>
                                <li style="margin-bottom: 10px;"><strong>Liability:</strong> Save Sathwa, its developers, and contributors are not liable for any injuries, damages, or losses resulting from the use of this platform or its tools. Users assume all risks associated with their use.</li>
                                <li><strong>Emergency Situations:</strong> In case of a snake bite or immediate danger, contact emergency services or a local wildlife authority immediately. Do not rely solely on this platform for life-threatening situations.</li>
                            </ul>
                            <p style="font-size: 1.1rem; color: #4a5568; line-height: 1.6;">
                                By using Save Sathwa, you agree to these terms and acknowledge the inherent risks involved. For further assistance, please refer to our <a href="{{ route('contact') }}" style="color: #667eea; text-decoration: none;">Contact Us</a> page.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection