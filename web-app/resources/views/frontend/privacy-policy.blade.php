@extends('frontend.layouts.master')

@section('content')
<main>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h1 class="display-4 mb-4">Privacy Policy</h1>
                    <p class="lead">Last Updated: May 16, 2025</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm p-4">
                        <h2 class="h4 mb-3">Introduction</h2>
                        <p>SaveSathwa ("we," "us," or "our") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services. Please read this policy carefully.</p>

                        <h2 class="h4 mb-3 mt-5">1. Information We Collect</h2>
                        <p>We may collect the following types of information:</p>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Personal Information:</strong> Name, email address, phone number, and payment details when you register or make a donation.</li>
                            <li class="list-group-item"><strong>Non-Personal Information:</strong> Browser type, IP address, and browsing behavior through cookies and analytics tools.</li>
                            <li class="list-group-item"><strong>Adoption Information:</strong> Details related to pet adoption applications, such as preferences and location.</li>
                        </ul>

                        <h2 class="h4 mb-3 mt-5">2. How We Use Your Information</h2>
                        <p>We use your information to:</p>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item">Process adoptions, donations, and other transactions.</li>
                            <li class="list-group-item">Send newsletters, updates, and promotional materials (you can opt-out anytime).</li>
                            <li class="list-group-item">Improve our website and services through analytics.</li>
                            <li class="list-group-item">Comply with legal obligations.</li>
                        </ul>

                        <h2 class="h4 mb-3 mt-5">3. How We Share Your Information</h2>
                        <p>We may share your information with:</p>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Service Providers:</strong> Third-party vendors for payment processing, analytics, and email services.</li>
                            <li class="list-group-item"><strong>Legal Authorities:</strong> When required by law or to protect our rights.</li>
                            <li class="list-group-item"><strong>Partners:</strong> Shelters and adoption agencies to facilitate pet adoptions.</li>
                        </ul>
                        <p>We do not sell your personal information to third parties.</p>

                        <h2 class="h4 mb-3 mt-5">4. Cookies and Tracking Technologies</h2>
                        <p>We use cookies to enhance your experience, analyze usage, and deliver personalized content. You can manage cookie preferences through your browser settings.</p>

                        <h2 class="h4 mb-3 mt-5">5. Data Security</h2>
                        <p>We implement industry-standard security measures to protect your data. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p>

                        <h2 class="h4 mb-3 mt-5">6. Your Rights</h2>
                        <p>You have the right to:</p>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item">Access, update, or delete your personal information.</li>
                            <li class="list-group-item">Opt-out of marketing communications.</li>
                            <li class="list-group-item">Request information about how your data is used.</li>
                        </ul>
                        <p>To exercise these rights, contact us at <a href="mailto:privacy@savesathwa.com">privacy@savesathwa.com</a>.</p>

                        <h2 class="h4 mb-3 mt-5">7. Children's Privacy</h2>
                        <p>Our services are not directed to individuals under 13. We do not knowingly collect personal information from children under 13. If we become aware of such data, we will delete it immediately.</p>

                        <h2 class="h4 mb-3 mt-5">8. Third-Party Links</h2>
                        <p>Our website may contain links to third-party sites. We are not responsible for the privacy practices of these sites and encourage you to review their policies.</p>

                        <h2 class="h4 mb-3 mt-5">9. International Data Transfers</h2>
                        <p>Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place to protect your data.</p>

                        <h2 class="h4 mb-3 mt-5">10. Changes to This Privacy Policy</h2>
                        <p>We may update this Privacy Policy periodically. Changes will be posted on this page with an updated "Last Updated" date. We encourage you to review this policy regularly.</p>

                        <h2 class="h4 mb-3 mt-5">11. Contact Us</h2>
                        <p>If you have questions about this Privacy Policy, please contact us:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Email:</strong> <a href="mailto:support@savesathwa.com">support@savesathwa.com</a></li>
                            <li class="list-group-item"><strong>Phone:</strong> <a href="tel:0111234567">011 1234567</a></li>
                            <li class="list-group-item"><strong>Address:</strong> SaveSathwa, 123 Pet Haven Road, Colombo, Sri Lanka</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection