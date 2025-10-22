jQuery( function ( $ ) {
	"use strict";
    $('#process-slider').slick({
        dots: true,
        infinite: true,
        fade: true,
        autoplay: false,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: false,
        nextArrow: false,
        swipeToSlide: true,
        cssEase: 'ease-in-out',
        appendDots: $('.dots'),
    });
});