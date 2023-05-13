jQuery(document).ready(function () {
    setInterval(function () {
        if (window.innerWidth < 960) {
            jQuery('li a.elementor-toc__list-item-text').on('click', function () {
                // alert("hgjkhjfh");
                jQuery('.elementor-toc__body').hide();
                jQuery(".project-table-of-content-wrapper").addClass("elementor-toc--collapsed");
            });
        }
    }, 500);

});
jQuery(document).ready(function () {
    jQuery(".ippi-social-shares-wrapper").hide();
    // jQuery("#ippi-share-btn").hover(function () {
    //     //jQuery("#ippi-share-btn").addClass("rotated");
    //     jQuery(this).addClass('rotated');
    //     jQuery(".ippi-social-shares-wrapper").toggle();
    // });
});

var maAdvancedCarousel = function ($scope, $) {
    var maAdvancedCarousel = $scope.find(".tm-slider").eq(0);

    maAdvancedCarousel.each(function (index, el) {
        var mobiles = jQuery(this).data('mobiles');
        var tabs = jQuery(this).data('tabs');
        jQuery(this).slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: tabs,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: mobiles,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

    jQuery(document).ready(function () {
        setTimeout(function () {
            jQuery('.tm-slider.slick-slider .slick-next, .post-slider.slick-slider .slick-next').addClass('fas fa-chevron-right');
            jQuery('.tm-slider.slick-slider .slick-prev, .post-slider.slick-slider .slick-prev').addClass('fas fa-chevron-left');
        }, 300);
    });

}

// Make sure you run this code under Elementor..
jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/advanced-carousel.default',
        maAdvancedCarousel
    );
});


jQuery(document).ready(function () {

    var tab_nav_wrapp = jQuery('.ippi-table-content-dropdown');
    var anchor = tab_nav_wrapp.find('li');

    // var text = jQuery('.ippi-table-content-dropdown .active a').text();
    // jQuery('.ippi-table-content-dropdown').append('<li class="selected"><a href="#">'+ text +'</a></li>');

    anchor.click(function (e) {
        e.preventDefault();
        jQuery(this).parents('.ippi-table-content-dropdown').toggleClass('tab-nav-open');
        jQuery(this).parents('.ippi-table-content-dropdown').find('li').removeClass('active');
        jQuery(this).addClass('active');
        var text = jQuery(this).find(a).text();
        // jQuery('.ippi-table-content-dropdown .selected a').text(text);
    });

    ippi_create_slider('ippi-latest-content-slider', 'ippi-latest-content-slick-next', 'ippi-latest-content-slick-prev');

    ippi_create_slider('ippi-experts-carousel-slider', 'ippi-experts-carousel-slide-next', 'ippi-experts-carousel-slide-prev');

    ippi_create_related_slider('ippi-related-programs-slider', 'ippi-related-program-slick-next', 'ippi-related-program-slick-prev');

    ippi_create_related_slider('ippi-related-content-slider', 'ippi-related-content-slick-next', 'ippi-related-content-slick-prev');

    ippi_create_slider('ippi-testimonial-slider', 'ippi-testimonial-slick-next', 'ippi-testimonial-slick-prev');

    ippi_create_slider('ippi-issue-areas-slider', 'ippi-issue-areas-slick-next', 'ippi-issue-areas-slick-prev');

    ippi_create_partners_slider('ippi-partners-slick-slider', 'ippi-partners-slick-next', 'ippi-partners-slick-prev');

    ippi_create_spacial_project_slider('ippi-spacial-project-slider', 'ippi-spacial-project-next', 'ippi-spacial-project-prev');

    //showmore and showless query for overview
    jQuery(`<a href="#" class="show-more"> Show More </a>`).insertAfter(".overview-text");
    jQuery(".show-more").click(function (e) {
        e.preventDefault();
        if (jQuery(".overview-text").hasClass("show-more-height")) {
            jQuery(this).text(" Show Less ").addClass('active');
        } else {
            jQuery(this).text(" Show More").removeClass('active');
        }
        jQuery(".overview-text").toggleClass("show-more-height");
    });
    console.log(jQuery('.ippi-table-content-mobile-view').find('.elementor-toc__list-wrapper'), '----------');
    jQuery('.ippi-table-content-mobile-view ul').append('<li class="custom-li-tag"> <a href="#elementor-toc__heading-anchor-1" class="elementor-toc__list-item-text elementor-item-active">What is Involved?</a></li>');

    console.log(jQuery('.elementor-toc__list-item-text'), 'dddssseeefffvv');


});

jQuery('.elementor-toc__list-item-text').ready(function () {

    // table content mobile view
    jQuery('.elementor-toc__list-item-text').change(function () {
        console.log('-=-=-=-=-');
    });

});


function ippi_create_slider(slide, next, prev) {
    var rtl = false;
    if (jQuery('body').hasClass('rtl')) {
        rtl = true;
    }


    jQuery('.' + slide).each(function (i, e) {

        var slider_id = jQuery(e).attr('slider-id');
        var createslider = jQuery(e);
        createslider.on('init', function (event, slick) {
            if (jQuery(this).find('ul.slick-dots li').length <= 1) {
                jQuery(this).find('ul.slick-dots').addClass('slick-hide-dots');
            }
        });

        var create = createslider.slick({
            slidesToShow: 3,
            // centerMode: true,
            slidesToScroll: 1,
            speed: 300,
            infinite: true,
            // autoplay: true,
            adaptiveHeight: true,
            dots: true,
            rtl: rtl,
            nextArrow: jQuery('.' + next + '-' + slider_id),
            prevArrow: jQuery('.' + prev + '-' + slider_id),
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    // slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            ]

        });
    });
}

function ippi_create_partners_slider(slide, next, prev) {
    var rtl = false;
    if (jQuery('body').hasClass('rtl')) {
        rtl = true;
    }

    jQuery('.' + slide).each(function (i, e) {
        var slider_id = jQuery(e).attr('slider-id');
        var partnerslider = jQuery(e);
        partnerslider.on('init', function (event, slick) {
            if (jQuery(this).find('ul.slick-dots li').length <= 1) {
                jQuery(this).find('ul.slick-dots').addClass('slick-hide-dots');
            }
        });

        var partner = partnerslider.slick({
            slidesToShow: 6,
            // centerMode: true,
            slidesToScroll: 1,
            speed: 300,
            autoplay: true,
            infinite: true,
            dots: true,
            rtl: rtl,
            nextArrow: jQuery('.' + next + '-' + slider_id),
            prevArrow: jQuery('.' + prev + '-' + slider_id),
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
            ]
        });
    });
}

function ippi_create_spacial_project_slider(slide, next, prev) {
    var rtl = false;
    if (jQuery('body').hasClass('rtl')) {
        rtl = true;
    }

    jQuery('.' + slide).each(function (i, e) {
        var slider_id = jQuery(e).attr('slider-id');
        //  var specialslider = jQuery(e);
        // specialslider.on('init', function (event, slick) {
        //     if (jQuery(this).find('ul.slick-dots li').length <= 1) {
        //         jQuery(this).find('ul.slick-dots').addClass('slick-hide-dots');
        //     }
        // });

        jQuery(e).slick({
            slidesToShow: 1,
            centerMode: true,
            rtl: rtl,
            nextArrow: jQuery('.' + next + '-' + slider_id),
            prevArrow: jQuery('.' + prev + '-' + slider_id),
        });

        jQuery(e).on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
            var i = (currentSlide ? currentSlide : 0) + 1;
            var slidesToShow = slick.slickGetOption('slidesToShow');
            var curPage = parseInt((i - 1) / slidesToShow) + 1;
            var lastPage = parseInt((slick.slideCount - 1) / slidesToShow) + 1;
            console.log(curPage, lastPage, '-=-=-=-=-=-');
            jQuery('.current-slide-count-' + slider_id).text(curPage);
            jQuery('.all-slide-count-' + slider_id).text(lastPage);
        });
    });
}




// function ippi_create_latest_slider(slide, next, prev) {

// }

function ippi_create_related_slider(slide, next, prev) {
    var rtl = false;
    if (jQuery('body').hasClass('rtl')) {
        rtl = true;
    }

    jQuery('.' + slide).each(function (i, e) {
        var slider_id = jQuery(e).attr('slider-id');
        var slider = jQuery(e);
        slider.on('init', function (event, slick) {
            if (jQuery(this).find('ul.slick-dots li').length <= 1) {
                jQuery(this).find('ul.slick-dots').addClass('slick-hide-dots');
            }
            //console.log(jQuery(this),'++++54ffggg');
        });
        var demo = slider.slick({
            slidesToShow: 3,
            // centerMode: true,
            slidesToScroll: 1,
            speed: 300,
            infinite: true,
            //autoplay: true,
            adaptiveHeight: true,
            dots: true,
            rtl: rtl,
            nextArrow: jQuery('.' + next + '-' + slider_id),
            prevArrow: jQuery('.' + prev + '-' + slider_id),

            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            ]

        });
        //console.log('1111');

        //console.log('22222');
    });
}
