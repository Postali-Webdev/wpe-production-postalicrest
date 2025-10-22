/**
 * Slick Custom
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

    $('#results').slick({
		dots: false,
        arrows: true,
		infinite: true,
		fade: false,
		autoplay: false,
  		autoplaySpeed: 5000,
  		speed: 1300,
		slidesToShow: 4,
		slidesToScroll: 1,
    	swipeToSlide: true,
		cssEase: 'ease-in-out',
        responsive: [
            {
                breakpoint: 1201,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 821,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
	});	
});