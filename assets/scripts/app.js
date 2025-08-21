/**
 * Required
 */
 
 //@prepros-prepend vendor/foundation/js/plugins/foundation.core.js

/**
 * Optional Plugins
 * Remove * to enable any plugins you want to use
 */
 
 // What Input
 //@*prepros-prepend vendor/whatinput.js
 
 // Foundation Utilities
 // https://get.foundation/sites/docs/javascript-utilities.html
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.box.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.imageLoader.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.keyboard.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.mediaQuery.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.motion.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.nest.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.timer.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.touch.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.triggers.min.js


// JS Form Validation
//@*prepros-prepend vendor/foundation/js/plugins/foundation.abide.js

// Tabs UI
//@*prepros-prepend vendor/foundation/js/plugins/foundation.tabs.js

// Accordian
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordion.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.accordionMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveAccordionTabs.js

// Menu enhancements
//@*prepros-prepend vendor/foundation/js/plugins/foundation.drilldown.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.dropdown.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.dropdownMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveToggle.js

// Equalize heights
//@prepros-prepend vendor/foundation/js/plugins/foundation.equalizer.js

// Responsive Images
//@*prepros-prepend vendor/foundation/js/plugins/foundation.interchange.js

// Navigation Widget
//@*prepros-prepend vendor/foundation/js/plugins/foundation.magellan.js

// Offcanvas Naviagtion Option
//@prepros-prepend vendor/foundation/js/plugins/foundation.offcanvas.js

// Carousel (don't ever use)
//@*prepros-prepend vendor/foundation/js/plugins/foundation.orbit.js

// Modals
//@*prepros-prepend vendor/foundation/js/plugins/foundation.reveal.js

// Form UI element
//@*prepros-prepend vendor/foundation/js/plugins/foundation.slider.js

// Anchor Link Scrolling
//@*prepros-prepend vendor/foundation/js/plugins/foundation.smoothScroll.js

// Sticky Elements
//@*prepros-prepend vendor/foundation/js/plugins/foundation.sticky.js

// On/Off UI Switching
//@*prepros-prepend vendor/foundation/js/plugins/foundation.toggler.js

// Tooltips
//@*prepros-prepend vendor/foundation/js/plugins/foundation.tooltip.js

// What Input
//@prepros-prepend vendor/what-input.js

// Swiper
//@prepros-prepend vendor/swiper-bundle.js

// DOM Ready
(function($) {
	'use strict';
    
    var _app = window._app || {};
    
    _app.foundation_init = function() {
        $(document).foundation();
    }
        
    _app.emptyParentLinks = function() {
            
        $('.menu li a[href="#"]').click(function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;
        });	
        
    };
    
    _app.fixed_nav_hack = function() {
        
        $('#offcanvas-nav').on('click', 'a', function() {
            $('.off-canvas').foundation('close');
        });
        
        $('.off-canvas').on('opened.zf.offCanvas', function() {
            $('header.site-header').addClass('off-canvas-content is-open-right has-transition-push');		
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').addClass('clicked');	
        });
        
        $('.off-canvas').on('close.zf.offCanvas', function() {
            $('header.site-header').removeClass('off-canvas-content is-open-right has-transition-push');
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
        });
        
        $(window).on('resize', function() {
            if ($(window).width() > 1023) {
                $('.off-canvas').foundation('close');
                $('header.site-header').removeClass('off-canvas-content has-transition-push');
                $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
            }
        });    
    }
    
    _app.scroll_to_anchor = function() {
    
        const offset = 0; // Adjust for sticky header, etc.
    
        // Scroll on page load if hash exists
        const hash = window.location.hash;
        if (hash) {
            const target = document.querySelector(hash);
            if (target) {
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
    
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        }
    
        // Smooth scroll on hash link clicks
        document.querySelectorAll('a[href*="#"]:not([href="#"])').forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.hash.slice(1);
                const target = document.getElementById(targetId);
    
                if (target) {
                    e.preventDefault();
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
    
                    history.pushState(null, null, `#${targetId}`);
                }
            });
        });
    
    }
    
    _app.display_on_load = function() {
        $('.display-on-load').css('visibility', 'visible');
    }
    
    // Custom Functions
    
    _app.mobile_takover_nav = function() {
        $(document).on('click', 'a#menu-toggle', function(){
            
            if ( $(this).hasClass('clicked') ) {
                $(this).removeClass('clicked');
                $('#off-canvas').fadeOut(200);
            
            } else {
            
                $(this).addClass('clicked');
                $('#off-canvas').fadeIn(200);
            
            }
            
        });
    }
    
    _app.testimonial_slider = function() {
        const slider = document.querySelector('.testimonials-slider');
        if( !slider ) return;
        
        const prevNav = slider.parentElement.parentElement.querySelector('.swiper-button-prev');
        const nextNav = slider.parentElement.parentElement.querySelector('.swiper-button-next');
        
        const pagination = slider.parentElement.parentElement.querySelector('.swiper-pagination'); 

        const swiper = new Swiper(slider, {
            loop: true,
            pagination: {
                el: pagination,
                clickable: true,
            },
            breakpoints: {
                640: {
                    navigation: {
                        nextEl: nextNav,
                        prevEl: prevNav,
                    },
                },
            },
        });
        
    }
    
    // Add inside your IIFE with other custom functions
_app.autofill_donate_from_plate = function() {
    console.log("[autofill] init");

    // normalize trailing slash
    var path = window.location.pathname.replace(/\/+$/, '');
    console.log("[autofill] pathname:", path);

    if (!/\/donate$/.test(path)) {
        console.log("[autofill] not a donate page, exiting");
        return;
    }

    var params = new URLSearchParams(window.location.search);
    var plate  = (params.get('plate') || '').trim();
    var state  = (params.get('state') || '').trim();
    console.log("[autofill] query params:", { plate, state });

    if (!plate || !state) {
        console.log("[autofill] missing plate or state, exiting");
        return;
    }

    // Optional: normalize state to uppercase
    state = state.toUpperCase();
    console.log("[autofill] normalized state:", state);

    // DOM refs
    var $vin   = $('.donate-form-vin input');
    var $year  = $('.donate-form-year input');
    var $make  = $('.donate-form-make input');
    var $model = $('.donate-form-model input');
    console.log("[autofill] field elements found:", {
        vin: $vin.length,
        year: $year.length,
        make: $make.length,
        model: $model.length
    });

    var disable = function(on){
        console.log("[autofill] disable fields:", on);
        [$vin, $year, $make, $model].forEach(function($el){
            $el.prop('disabled', !!on);
        });
    };

    var fill = function(data){
        console.log("[autofill] fill called with:", data);
        if (!data) return;
        if (data.vin   != null) { $vin.val(data.vin).trigger('change'); console.log("[autofill] filled vin:", data.vin); }
        if (data.year  != null) { $year.val(data.year).trigger('change'); console.log("[autofill] filled year:", data.year); }
        if (data.make  != null) { $make.val(data.make).trigger('change'); console.log("[autofill] filled make:", data.make); }
        if (data.model != null) { $model.val(data.model).trigger('change'); console.log("[autofill] filled model:", data.model); }
    };

    disable(true);

    console.log("[autofill] sending AJAX request", { plate, state });
    $.ajax({
        url: '/wp-json/vehdb/v1/license-decode',
        method: 'GET',
        dataType: 'json',
        data: { plate: plate, state: state },
        timeout: 10000
    })
    .done(function(res){
        console.log("[autofill] ajax success:", res);
        if (res && !res.error) {
            fill(res);
        } else {
            console.warn("[autofill] ajax returned error or empty:", res);
        }
    })
    .fail(function(xhr, status, err){
        console.error("[autofill] ajax failed:", status, err, xhr);
    })
    .always(function(){
        console.log("[autofill] ajax complete, re-enabling fields");
        disable(false);
    });
};


    // then register it in your init:
    _app.init = function() {
        // Standard
        _app.foundation_init();
        _app.emptyParentLinks();
        _app.fixed_nav_hack();
        _app.display_on_load();
        _app.scroll_to_anchor();

        // Custom
        _app.testimonial_slider();

        // 👇 your new workflow hook
        _app.autofill_donate_from_plate();
    };

    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);