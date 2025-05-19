@extends('frontend.layouts.master')

@section('content')
<main>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Frequently Asked Questions</h1>
                    <p>Get answers to common queries</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-block">
                        <h2>General Questions</h2>
                        <div class="faq-item">
                            <h3>What is SaveSathwa?</h3>
                            <p>SaveSathwa is a platform dedicated to rescuing and rehoming animals, connecting them with loving families.</p>
                        </div>
                        <div class="faq-item">
                            <h3>How can I adopt a pet?</h3>
                            <p>Visit our adoption page, fill out an application, and our team will guide you through the process.</p>
                        </div>

                        <h2>Adoption Process</h2>
                        <div class="faq-item">
                            <h3>What are the adoption requirements?</h3>
                            <p>You need to be over 18, provide a suitable home environment, and pass a background check.</p>
                        </div>
                        <div class="faq-item">
                            <h3>How long does adoption take?</h3>
                            <p>The process typically takes 1-2 weeks, depending on verification and availability.</p>
                        </div>

                        <h2>Donations and Support</h2>
                        <div class="faq-item">
                            <h3>How can I donate?</h3>
                            <p>You can donate via our website using a credit card or bank transfer. Details are on the donation page.</p>
                        </div>
                        <div class="faq-item">
                            <h3>Are donations tax-deductible?</h3>
                            <p>Yes, donations to SaveSathwa are tax-deductible. Please consult your tax advisor for details.</p>
                        </div>

                        <h2>Contact and Support</h2>
                        <div class="faq-item">
                            <h3>How do I contact support?</h3>
                            <p>Email us at <a href="mailto:support@savesathwa.com">support@savesathwa.com</a> or call 011 1234567.</p>
                        </div>
                        <div class="faq-item">
                            <h3>What are your operating hours?</h3>
                            <p>We are available Monday to Friday, 9 AM to 5 PM (IST).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection