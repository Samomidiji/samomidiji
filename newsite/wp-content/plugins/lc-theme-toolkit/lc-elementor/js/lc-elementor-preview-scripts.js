(function ($) {
	"use strict";

	function scrollAnim() {

	    // init ScrollMagic
	    var scrollMagic = new ScrollMagic.Controller();

	    // Animation text line
	    var $textFadeUp = $('.textFadeUp');

	    $textFadeUp.each(function(i) {
	        var splitone = new SplitText($textFadeUp[i], { type: 'lines' });
	        var tweenLine = new TimelineMax({
	            delay: .6,
	        });

	        //if (!isMobile) {
	        tweenLine.staggerFrom(splitone.lines, .6, {
	            y: 50,
	            opacity: 0,
	            ease: 'Circ.easeOut'
	        }, 0.2);
	        //}

	        new ScrollMagic.Scene({
	                triggerElement: this,
	                triggerHook: 'onEnter',
	                reverse: false
	            })
	            .setTween(tweenLine)
	            .addTo(scrollMagic);
	    });

	    // Reveal
	    var reveal = document.querySelectorAll('.reveal-effect');

	    $.each(reveal, function(index, reveal_item) {
	        // if (!isMobile) {
	            new ScrollMagic.Scene({
	                triggerElement: reveal_item,
	                triggerHook: 'onEnter',
	                reverse: false
	            })
	            .setClassToggle(reveal_item, 'animated')
	            .addTo(scrollMagic);
	        // }
	    });
	}

	var lc_parralax_background = function() {
		parallaxbg();
		function parallaxbg() {
		    if ($('.parallax-inner').length > 0) {
		        $('.parallax-background').parallaxBackground({
		            event: 'mouse_move',
		            animation_type: 'shift',
		            animate_duration: 3,
		        });

		        $('.portfolio-parallax, .fixed-bg').parallaxBackground();
		    }
		}
	};

	var lc_slider = function() {
		scrollAnim();
		project_slider1();
		project_slider2();
		
		function project_slider1() {
		    if ($('#projectSlider1').length > 0) {
		        var testimonialSwiper = new Swiper('#projectSlider1', {
		            slidesPerView: 3,
		            spaceBetween: 30,
		            centeredSlides: true,
		            scrollbar: {
		                el: '.swiper-scrollbar',
		                hide: false,
		            },
		            autoplay: {
		                delay: 3000,
		                disableOnInteraction: false,
		            },
		            breakpoints: {
		                768: {
		                    slidesPerView: 1,
		                    spaceBetween: 15,
		                },
		            }
		        });
		    }
		}
		function project_slider2() {
		    if ($('#projectSlider2').length > 0) {
		        var testimonialSwiper = new Swiper('#projectSlider2', {
		            slidesPerView: 1,
		            loop: true,
		            navigation: {
		                nextEl: '.swiper-button-next',
		                prevEl: '.swiper-button-prev',
		            },
		            effect: 'fade',
		        });
		    }
		}
	}

	var lc_video = function() {
		scrollAnim();
		popupVideo();
		//Detect device mobile
		var isMobile = false;
		if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || ($(window).width()<1024)) {
		    $('body').addClass('mobile');
		    isMobile = true;
		} else {
		    isMobile = false;
		}
		//Custom Cursor
		if(!isMobile) {
		    var $circleCursor = $('.cursor');

		    function moveCursor(e) {
		        var t = e.clientX + "px",
		            n = e.clientY + "px";
		        TweenMax.to($circleCursor, .3, {
		            left: t,
		            top: n,
		            ease: 'Power1.easeOut'
		        });
		    }
		    $(window).on('mousemove', moveCursor);

		    function zoomCursor() {
		        TweenMax.to($circleCursor, .3, {
		            opacity: 1,
		            scale: 1,
		            ease: 'Power1.easeOut'
		        });
		    }

		    $(document).on('mouseenter', 'a, .zoom-cursor', zoomCursor);

		    function defaultCursor() {
		        TweenLite.to($circleCursor, .1, {
		            opacity: 0.5,
		            scale: .3,
		            ease: 'Power1.easeOut'
		        });
		    }

		    $(document).on('mouseleave', 'a, .zoom-cursor', defaultCursor);
		}
		function popupVideo() {
		    $('.popup-video').magnificPopup({
		        disableOn: 700,
		        type: 'iframe',
		        mainClass: 'mfp-fade',
		        removalDelay: 160,
		        preloader: false,
		        fixedContentPos: false
		    });
		}
	};

	var lc_portfolio = function() {
		scrollAnim();
		imgLoad();
		portfolio();
		//Detect device mobile
		var isMobile = false;
		if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || ($(window).width()<1024)) {
		    $('body').addClass('mobile');
		    isMobile = true;
		} else {
		    isMobile = false;
		}
		//Img load
		function imgLoad() {
		    $('.portfolio-item').each(function() {
		        var image = $(this).find('a').data('src');
		        $(this).find('.portfolio-img-content').css({ 'background-image': 'url(' + image + ')', 'background-size': 'cover', 'background-position': 'center' });
		    });
		}
		//Custom Cursor
		if(!isMobile) {
		    var $circleCursor = $('.cursor');

		    function moveCursor(e) {
		        var t = e.clientX + "px",
		            n = e.clientY + "px";
		        TweenMax.to($circleCursor, .3, {
		            left: t,
		            top: n,
		            ease: 'Power1.easeOut'
		        });
		    }
		    $(window).on('mousemove', moveCursor);

		    function zoomCursor() {
		        TweenMax.to($circleCursor, .3, {
		            opacity: 1,
		            scale: 1,
		            ease: 'Power1.easeOut'
		        });
		    }

		    $(document).on('mouseenter', 'a, .zoom-cursor', zoomCursor);

		    function defaultCursor() {
		        TweenLite.to($circleCursor, .1, {
		            opacity: 0.5,
		            scale: .3,
		            ease: 'Power1.easeOut'
		        });
		    }

		    $(document).on('mouseleave', 'a, .zoom-cursor', defaultCursor);
		}
		//Portfolio masonry
		function portfolio() {

		    if ($('#portfolio-container').length > 0) {

		        var $container = $('#portfolio-container');
		        $container.isotope({
		            masonry: {
		                columnWidth: '.portfolio-item'
		            },
		            itemSelector: '.portfolio-item'
		        });
		        $('#filters').on('click', 'li', function() {
		            $('#filters li').removeClass('active');
		            $(this).addClass('active');
		            var filterValue = $(this).attr('data-filter');
		            $container.isotope({ filter: filterValue });
		        });

		        //Title Floating Tooltip
		        if (!isMobile && $('.title-tooltip').length > 0 ) {

		            $(".cursor").append('<div class="title-caption-tooltip"></div>');
		            $("#portfolio-container.title-tooltip").find(".portfolio-item .portfolio-text-content").each(function() {
		                $(".title-caption-tooltip").append($(this))
		            }),

		            $("#portfolio-container").find(".portfolio-item a").on("mouseenter", function(e) {
		                $(".title-caption-tooltip").children().eq($(this).parent().index()).addClass("hover")
		            }).on("mouseleave", function(e) {
		                $(".title-caption-tooltip").children().eq($(this).parent().index()).removeClass("hover")
		            }).on("click", function() {
		                $(".title-caption-tooltip").children().eq($(this).parent().index()).removeClass("hover")
		            });

		            $(".portfolio-item").on('mouseenter', function() { 
		                $circleCursor.css('background-color', 'transparent');
		                $circleCursor.css('mix-blend-mode', 'normal');
		            });

		            $('.portfolio-item').on('mouseenter', zoomCursor);

		            $(".portfolio-item").on('mouseleave', function() { 
		                $circleCursor.css('background-color', '#ff0000');
		                $circleCursor.css('mix-blend-mode', 'multiply');
		            });

		            $('.portfolio-item').on('mouseleave', defaultCursor);
		        }
		    }
		}
	};

	var lc_contact = function() {
		submitInputToButton();
		function submitInputToButton() {
		    $('input[type="submit"]').replaceWith('<div class="form-submit"><button type="submit">' + $('input[type="submit"]').val() +'</button></div>');
		}
	}

	var lc_map = function() {
		map();
		function map() {
		    if ($('#mapid').length > 0) {
		        var lat = $('#mapid').data('lat');
		        var lang = $('#mapid').data('lang');
		        var marker = "<img src='"+$('#mapid').data('markericon')+"'>";
		        var mymap = L.map('mapid').setView([lat, lang], 20);
		        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		            maxZoom: 18,
		            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		            id: 'mapbox.streets'
		        }).addTo(mymap);

		        var popup = L.popup()
		            .setLatLng([lat, lang])
		            .setContent(marker)
		            .openOn(mymap);
		    }
		}
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/lc-parralax-background.default', lc_parralax_background);
		elementorFrontend.hooks.addAction('frontend/element_ready/lc-slider.default', lc_slider);
		elementorFrontend.hooks.addAction('frontend/element_ready/lc-video.default', lc_video);
		elementorFrontend.hooks.addAction('frontend/element_ready/lc-portfolio.default', lc_portfolio);
		elementorFrontend.hooks.addAction('frontend/element_ready/lc-contact.default', lc_contact);
		elementorFrontend.hooks.addAction('frontend/element_ready/lc-map.default', lc_map);
		
	});
})(jQuery);