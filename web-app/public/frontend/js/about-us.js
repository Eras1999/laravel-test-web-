$(document).ready(function() {
    // Initialize Slick Slider for Key Features
    $('.features-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
        arrows: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // Optional: Add a fade-in animation for the hero section title
    $('.about-hero-overlay h1').fadeIn(1500);
});