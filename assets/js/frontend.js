jQuery(document).ready(function($) {
    // Featured posts carousel functionality
    $('.cps-featured-posts').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    
    // Category filter functionality
    $('.cps-category-filter select').on('change', function() {
        var category = $(this).val();
        window.location.href = $(this).data('base') + category;
    });
});